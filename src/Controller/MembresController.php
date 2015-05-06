<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Session\DatabaseSession;
use Cake\ORM\TableRegistry;
/**
 * Membres Controller
 *
 * @property \App\Model\Table\MembresTable $Membres
 */
class MembresController extends AppController
{

	public function initialize() {
		parent::initialize();
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','1');
	    $session->write('Progress.SousMenu','0');

	}

	
	public function isAuthorized($user)
	{
			
		// Droits de tous les utilisateurs connectes sur les actions
		if(in_array($this->request->action, ['index','edit','view','delete','add'])){
			return true;
		}
		
		return parent::isAuthorized($user);
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index($comite = 0)
    {
		//Liste des membres
        $session = $this->request->session();
    	$membres = $this->Membres->find('all')
    	->contain(['Demarches', 'Responsabilites', 'Fonctions', 'Services'])
    	->where(['comite'=>$comite,'demarche_id'=>$session->read('Equipe.Demarche')]);    	
    	
    	$responsabilites = $this->Membres->Responsabilites->find('list', ['limit' => 200]);
    	$fonctions = $this->Membres->Fonctions->find('list', ['limit' => 200]);
    	$services = $this->Membres->Services->find('list', ['limit' => 200]);
    	$this->set(compact('demarches', 'responsabilites', 'fonctions', 'services','comite'));    	
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
    public function view($id = null)
    {
        $membre = $this->Membres->get($id, [
            'contain' => ['Demarches', 'Responsabilites', 'Fonctions', 'Services']
        ]);
        $this->set('membre', $membre);
        $this->set('_serialize', ['membre']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$membre = $this->Membres->newEntity();
        if ($this->request->is('post')) {  
        	//Recuperation des données du formulaire      
        	$donnees = $this->request->data;
        	
        	$membreUnique = $this->Membres->find()->where(['nom'=>$donnees['nom'],'prenom'=>$donnees['prenom']])->count();
        	if($membreUnique >0) {
        		$this->Flash->error('Ajout IMPOSSIBLE. Le membre est déjà présent dans cette équipe pour cette démarche');        		
        		return $this->redirect(['action' => 'index']);
        	} else {
	        	$membresTable = TableRegistry::get('Membres');
				$membre = $membresTable->newEntity();	        	
	        	$session = $this->request->session();
	        	
	        	$membre->nom = $donnees['nom']; 
	        	$membre->prenom = $donnees['prenom']; 
	        	$membre->email = $donnees['email']; 
	        	$membre->telephone = $donnees['telephone']; 
	        	$membre->comite = $donnees['comite'];; //Ajout d'un membre ou membre du comite de pilotage
	        	$membre->demarche_id = $session->read('Equipe.Demarche'); 
	        	$membre->responsabilite_id = $donnees['responsabilite_id']; 
	        	$membre->fonction_id = $donnees['fonction_id']; 
	        	$membre->service_id = $donnees['service_id'];
	        	        	
	        	if ($this->Membres->save($membre)) {
	                $this->Flash->success('Le membre de l\'équipe a bien été ajouté.');
	                return $this->redirect(['action' => 'index']);
	            } else {
	                $this->Flash->error('Erreur dans l\'ajout du membre');
	            }
        	}
        }
//         $demarches = $this->Membres->Demarches->find('list', ['limit' => 200]);
//         $responsabilites = $this->Membres->Responsabilites->find('list', ['limit' => 200]);
//         $fonctions = $this->Membres->Fonctions->find('list', ['limit' => 200]);
//         $services = $this->Membres->Services->find('list', ['limit' => 200]);
//         $this->set(compact('membre', 'demarches', 'responsabilites', 'fonctions', 'services'));
//         $this->set('_serialize', ['membre']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Membre id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $membre = $this->Membres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $membre = $this->Membres->patchEntity($membre, $this->request->data);
            if ($this->Membres->save($membre)) {
                $this->Flash->success('Le membre a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde du membre.');
            }
        }
        $demarches = $this->Membres->Demarches->find('list', ['limit' => 200]);
        $responsabilites = $this->Membres->Responsabilites->find('list', ['limit' => 200]);
        $fonctions = $this->Membres->Fonctions->find('list', ['limit' => 200]);
        $services = $this->Membres->Services->find('list', ['limit' => 200]);
        $this->set(compact('membre', 'demarches', 'responsabilites', 'fonctions', 'services'));
        $this->set('_serialize', ['membre']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Membre id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membre = $this->Membres->get($id);
        if ($this->Membres->delete($membre)) {
            $this->Flash->success('Le membre a bien été supprimé.');
        } else {
            $this->Flash->error('Erreur dans la suppression du membre.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
