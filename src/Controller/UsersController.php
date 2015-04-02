<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class UsersController extends AppController
{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		// Permet aux utilisateurs de s'enregistrer et de se déconnecter.
		$this->Auth->allow(['add', 'logout']);
	}
	
	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__("Nom d'utilisateur ou mot de passe incorrect, essayez à nouveau."));
		}
	}
	
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
	public function index()
	{
		$this->set('users', $this->Users->find('all'));
	}

	public function view($id)
	{
		if (!$id) {
			throw new NotFoundException(__('utilisateur non valide'));
		}

		$user = $this->Users->get($id);
		$this->set(compact('user'));
	}

	public function add()
	{
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success(__("L'utilisateur a été sauvegardé."));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
		}
		$this->set('user', $user);
	}

}