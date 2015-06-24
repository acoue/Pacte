<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Descriptions Controller
 *
 * @property \App\Model\Table\DescriptionsTable $Descriptions
 */
class DescriptionsController extends AppController
{
	public function initialize() {
		parent::initialize();
	}

	
	public function isAuthorized($user)
	{			
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {
		// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','add','edit','delete'])){
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
    public function index($id_projet = null)
    {
    	$query = $this->Descriptions->find('all')
    	->contain(['Fonctions', 'Projets'])
    	->where(['Descriptions.projet_id' => $id_projet]);
    	$this->set('descriptions', $this->paginate($query));
    	$this->set(compact('id_projet'));
        $this->set('_serialize', ['descriptions']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id_projet = null)
    {
    	
        $description = $this->Descriptions->newEntity();
        if ($this->request->is('post')) {
        	
			//Verification que il n'existe qu'une ligne fonction / service pour le projet        	
        	$ligneUnique = $this->Descriptions->find()
        									  ->where(['fonction_id'=>$this->request->data['fonction_id'],
        									  			'projet_id' => $id_projet])
        									  ->count();
        	if($ligneUnique >0) {
        		$this->Flash->error('Erreur, l\'information pour cette fonction existe déjà pour ce projet');        		
        		return $this->redirect(['controller'=>'projets','action' => 'index']);
        	} else {        		
        		//Ajout        	
	        	$description = $this->Descriptions->patchEntity($description, $this->request->data);
	            if ($this->Descriptions->save($description)) {
	                $this->Flash->success('La description de l\'équipe a bien été sauvegardée.');       		
        			return $this->redirect(['controller'=>'projets','action' => 'index']);
	            } else {
	                $this->Flash->error('Erreur dans la sauvegarde de la présentation de l\'équipe.');       		
        			return $this->redirect(['controller'=>'projets','action' => 'index']);
	            }
        	}
        }
        $fonctions = $this->Descriptions->Fonctions->find('list');
        $this->set(compact('description', 'fonctions','id_projet'));
        $this->set('_serialize', ['description']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Description id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $description = $this->Descriptions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $description = $this->Descriptions->patchEntity($description, $this->request->data);
            if ($this->Descriptions->save($description)) {
                $this->Flash->success('La description de l\'équipe a bien été sauvegardée.');
                return $this->redirect(['controller'=>'projets','action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la description de l\'équipe .');
                return $this->redirect(['controller'=>'projets','action' => 'index']);
            }
        }
        $fonctions = $this->Descriptions->Fonctions->find('list', ['limit' => 200]);
        $projets = $this->Descriptions->Projets->find('list', ['limit' => 200]);
        $this->set(compact('description', 'fonctions', 'projets'));
        $this->set('_serialize', ['description']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Description id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $description = $this->Descriptions->get($id);
        $id_projet = $description->projet_id;
        if ($this->Descriptions->delete($description)) {
            $this->Flash->success('La description de l\'équipe a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur dans la suppression de la description de l\'équipe .');
        }
        return $this->redirect(['controller'=>'projets','action' => 'index']);
    }
}
