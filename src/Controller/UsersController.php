<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Network\Request;
use Cake\Network\Email\Email;

class UsersController extends AppController
{
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['activate', 'login', 'logout','password']);
	}
	
	public function isAuthorized($user)
	{
		
		// Tous les utilisateurs peuvent se deconnecter
		if ($this->request->action === 'logout') {			
			return true;
		} 
		
		return parent::isAuthorized($user);
	}
	
	public function activate($token =null) {
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','0');
	    $session->write('Progress.SousMenu','0');
		
		if(!isset($token)) {
			$this->Flash->error(__("Ce lien d'activation ne semble pas valide."));
			$this->redirect("/users/login");
		} else {
			$tokenTab = explode('-',$token);
			$user = $this->Users->find('all')->where(['id'=>$tokenTab[0],'token'=>$tokenTab[1], 'active'=>'0'])->first();
			//debug($user); die();
			
			if(!empty($user)){
				$usersTable = TableRegistry::get('Users');
				$modif_user = $usersTable->get($user->id); 			
				$modif_user->active = 1;	
				//Mise à jour du token pour eviter une 2eme validation
				$length = 8;
				$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length*4);
				$modif_user->token = $token;
				$usersTable->save($modif_user);
				//Login du User
				$this->Auth->setUser($user);
				//Mise en session des element ID et ROLE
				$session = $this->request->session();
				$session->write('User.Id', $user['id']);
				$session->write('User.Role', $user['role']);
				$this->Flash->success(__("Votre compte a bien été validé."));
				$this->redirect("/");
				
			} else {
				//debug($this->request->data); die();
				$this->Flash->error(__("Ce lien d'activation ne semble pas valide."));
				$this->redirect("/users/login");
			}
		}
	}
	
	public function login()
	{	
    	//Menu et sous-menu
    	$session = $this->request->session();
    	$session->write('Progress.Menu','0');
    	$session->write('Progress.SousMenu','0');
		
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {						
				//Mise a jour de la date de last login 
				$usersTable = TableRegistry::get('Users');
				$modif_user = $usersTable->get($user['id']);
				$modif_user->lastlogin = date('Y-m-d H:i:s');
				$usersTable->save($modif_user);
				
				$this->Auth->setUser($user);
				
				//Mise en session des element ID et ROLE
				$session = $this->request->session();
				$session->write('User.Id', $user['id']);
				$session->write('User.Role', $user['role']);
				return $this->redirect($this->Auth->redirectUrl());
			}

			//Destruction de la session
			$session = $this->request->session();
			$session->destroy();
			$this->Flash->error(__("Nom d'utilisateur ou mot de passe incorrect, essayez à nouveau."));
		}
	}
	
	public function logout()
	{	
		$session = $this->request->session();
		$session->destroy();
		$this->Flash->success('Vous êtes maintenant déconnecté.');
		return $this->redirect($this->Auth->logout());
	}
	
// 	public function index()
// 	{
// 		$this->set('users', $this->Users->find('all'));
// 	}

// 	public function view($id)
// 	{
// 		if (!$id) {
// 			throw new NotFoundException(__('utilisateur non valide'));
// 		}

// 		$user = $this->Users->get($id);
// 		$this->set(compact('user'));
// 	}

// 	public function add()
// 	{
// 		$user = $this->Users->newEntity();
// 		if ($this->request->is('post')) {
// 			$user = $this->Users->patchEntity($user, $this->request->data);
// 			if ($this->Users->save($user)) {
// 				$this->Flash->success(__("L'utilisateur a &eacute;t&eacute; sauvegard&eacute;."));
// 				return $this->redirect(['action' => 'index']);
// 			}
// 			$this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
// 		}
// 		$this->set('user', $user);
// 	}

	public function compte() {
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','0');
	    $session->write('Progress.SousMenu','0');
	    
		$user_id = $this->Auth->user('id');
		if(!$user_id) {
			$this->redirect('/');
			die();
		}
		$d = $this->request->data;
		//debug($d);die();
		$usersTable = TableRegistry::get('Users');
		$modif_user = $usersTable->get($user_id);
		if ($this->request->is(['post', 'put'])) {			
			if(!empty($d['pass1'])) {
				if($d['pass1'] == $d['pass2']) {
					$modif_user->password = $d['pass1'];
					if($usersTable->save($modif_user)){
						$this->Flash->success('Modification du profil effectuée.');
					} else {
						$this->Flash->error('Impossible de sauvegarder.');
					}
				} else {
					$this->Flash->error('Les mots de passe ne correspondent pas');
				}
			} else $this->Flash->error('Merci de renseigner un mot de passe');
		}		
	}
	
	public function password() {
		
		//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','0');
	    $session->write('Progress.SousMenu','0');
	    
	    if(!empty($this->request->query['token'])){
	    	$token = $this->request->query['token'];
	    	$tokenTab = explode('-',$token);
	    	$user = $this->Users->find('all')->where(['id'=>$tokenTab[0],'token'=>$tokenTab[1], 'active'=>'1'])->first();
	    	
	    	//debug($user);die();
	    	
	    	//debug($user); die();
	    	if($user){
				$usersTable = TableRegistry::get('Users');
				$modif_user = $usersTable->get($user->id); 
				//Mise à jour du token pour eviter une 2eme validation
				$length = 8;
				$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length*4);
				$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				$modif_user->token = $token;
				$modif_user->password = $password;
				$usersTable->save($modif_user);				
				//Affichage du mot de passe
				$this->Flash->success(__("Votre mot de passe a bien été réinitialisé, voici votre nouveau mot de passe : $password"));
			} else {
				$this->Flash->error(__("Ce lien ne semble pas valide."));
			}
	    }
	    
	    if ($this->request->is(['post'])) {
	    	$d = $this->request->data;    	
	    	$user = $this->Users->find('all')->where(['username'=> $d['identifiant']])->first();
	    	if(empty($user)) {
	    		$this->Flash->error('Aucun utilisateur ne correspond à cet identifiant.');	    	
	    	} else {
	    		//Enregistrement de l'ID en session en cas de retour
	    		$link = ['controller'=>'users', 'action' => 'password', 'token'=> $user->id."-".$user->token, '_full' => true];
	    		 
	    		$email = new Email('default');
	    		$email->template('mdp')
	    		->emailFormat('html')
	    		->to($d['email'])
	    		->from('refex@has-sante.fr')
	    		->subject('[Pacte] Regénération de mot de passe')
	    		->viewVars(['link'=>$link])
	    		->send();

	    		$this->Flash->success('Un message vient de vous être envoyé pour regénérer votre mot de passe.');
	    	}
	    }
	    
	    
		
	}
	
}