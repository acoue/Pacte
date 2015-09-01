<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Session\DatabaseSession;
use Cake\ORM\TableRegistry;
use Cake\Network\Request;
/**
 * Membres Controller
 *
 * @property \App\Model\Table\MembresTable $Membres
 */
class MembresController extends AppController
{

	public function initialize() {
		parent::initialize();

	}

	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {	
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','edit','view','delete','add'])){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index($comite = 0, $type=0)
    {
    	
    	//TYPE : 1 = membres referent, 0 = membres 
    	//COMITE : 1 = selection des membres du comité, 0 = selection des membres de l'equipe
    	
		//Liste des membres
        $session = $this->request->session();
         
        if($type == 1 ) { //Membre referents
	    	$membres = $this->Membres->find('all')
	    	->contain(['Demarches', 'Responsabilites'])
	    	->where(['comite'=>$comite,'demarche_id'=>$session->read('Equipe.Demarche'), 'responsabilite_id > ' => 1]);
        	
        } else {
	    	$membres = $this->Membres->find('all')
	    	->contain(['Demarches', 'Responsabilites'])
	    	->where(['comite'=>$comite,'demarche_id'=>$session->read('Equipe.Demarche')]);        	
        }
    	    	
    	if($type==1) $responsabilites = $this->Membres->Responsabilites->find('list')->where(['online'=>1,' id >'=>'1']);
    	else $responsabilites = $this->Membres->Responsabilites->find('list')->where(['online'=>1]);
    	

    	$this->loadModel('Parametres');
    	//Message
    	$messageReferent = $this->Parametres->find('all')->where(['name' => 'MessageAccueilReferent'])->first();
    	$messageMembre = $this->Parametres->find('all')->where(['name' => 'MessageAccueilMembre'])->first();
    	$messageComite = $this->Parametres->find('all')->where(['name' => 'MessageAccueilComite'])->first();
    	
    	$this->set(compact('demarches', 'responsabilites', 'comite', 'type','messageReferent','messageMembre','messageComite'));    	
        $this->set('membres', $membres);
        $this->set('_serialize', ['membres']);
    }

    /**
     * View method
     *
     * @param string|null $id Membre id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null,$comite=0,$type=0,$url=null)
    {
    	//debug($this->request);die();
        $membre = $this->Membres->get($id, [
            'contain' => ['Demarches', 'Responsabilites']
        ]);
        $this->set('membre', $membre);
        $this->set(compact('comite', 'type','url'));
        $this->set('_serialize', ['membre']);
        
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($comite=0,$type=0)
    {
    	
    	
        //$membre = $this->Membres->newEntity();
        if ($this->request->is('post')) {  
        	//Recuperation des données du formulaire      
        	$donnees = $this->request->data; 
        	//TYPE : 1 = membres referent, 0 = membres
        	$type = $donnees['type'];
	        $session = $this->request->session();
        	
        	$membreUnique = $this->Membres->find()->where(['nom'=>$donnees['nom'],
        													'prenom'=>$donnees['prenom'],
        													'demarche_id' => $session->read('Equipe.Demarche'), 
        													'comite' => $donnees['comite']])->count();
        	if($membreUnique >0) {
        		$this->Flash->error('Erreur, le membre est déjà présent dans cette équipe pour cette démarche');     
        		if($donnees['responsabilite_id'] == 5) {
        			return $this->redirect(['controller'=>'projets','action' => 'index']);
        		} else if($type == 1 ){
        			return $this->redirect(['action' => 'index/0/1']);
        		} else {
        			return $this->redirect(['controller'=>'projets','action' => 'index']);
        		}
        		
        		
        		
        		
        	} else {
	        	$membresTable = TableRegistry::get('Membres');
				$membre = $membresTable->newEntity();	
	        	
	        	$membre->nom = $donnees['nom']; 
	        	$membre->prenom = $donnees['prenom']; 
	        	$membre->email = $donnees['email']; 
	        	$membre->telephone = $donnees['telephone']; 
	        	$membre->comite = $donnees['comite']; //Ajout d'un membre ou membre du comite de pilotage
	        	$membre->demarche_id = $session->read('Equipe.Demarche'); 
	        	$membre->responsabilite_id = $donnees['responsabilite_id']; 
	        	$membre->fonction = $donnees['fonction']; 
	        	$membre->service = $donnees['service'];
	        	        	
	        	
	        	if ($this->Membres->save($membre)) {
	        		
	        		//Retour vers ajout du membre du comite
	        		if($donnees['responsabilite_id'] == 5) {
	        			$this->Flash->success('Le membre du comité de pilotage a bien été ajouté.');      		
        				return $this->redirect(['controller'=>'projets','action' => 'index']);
	        			//return $this->redirect(['action' => 'index/1/0']);
	        		} else if($type == 1 ){
	        			$this->Flash->success('Le membre référent de l\'équipe a bien été ajouté.');
	                	return $this->redirect(['action' => 'index/0/1']);
	        		} else {
	        			$this->Flash->success('Le membre de l\'équipe a bien été ajouté.');
	        			return $this->redirect(['controller'=>'projets','action' => 'index']);
	                	//return $this->redirect(['action' => 'index/0/0']);
	        		}
	            } else {
	                $this->Flash->error('Erreur dans l\'ajout du membre');
	            }
        	}
        }

        $this->set(compact('comite', 'type'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Membre id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$comite=0,$type=0,$url=null)
    {
    	//debug($this->request);die();
        $membre = $this->Membres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $membre = $this->Membres->patchEntity($membre, $this->request->data);
            if ($this->Membres->save($membre)) {
                $this->Flash->success('Le membre a bien été sauvegardé.');
                $this->set(compact('comite', 'type'));
                return $this->redirect(['action' => 'index/'.$comite.'/'.$type]);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde du membre.');
            }
        }
        $demarches = $this->Membres->Demarches->find('list', ['limit' => 200]);
        $responsabilites = $this->Membres->Responsabilites->find('list', ['limit' => 200])->where(['online'=>1]);
        $this->set(compact('membre', 'demarches', 'responsabilites','comite', 'type','url'));
        $this->set('_serialize', ['membre']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Membre id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null,$comite=0,$type=0,$url=null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membre = $this->Membres->get($id);
        if ($this->Membres->delete($membre)) {
            $this->Flash->success('Le membre a bien été supprimé.');
        } else {
            $this->Flash->error('Erreur dans la suppression du membre.');
        }
        if($url) return $this->redirect(['controller'=>'projets','action' => 'index']); 
        return $this->redirect(['action' => 'index/'.$comite.'/'.$type]);
    }
}
