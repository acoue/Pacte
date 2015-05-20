<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CalendrierProjets Controller
 *
 * @property \App\Model\Table\CalendrierProjetsTable $CalendrierProjets
 */
class CalendrierProjetsController extends AppController
{
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['edit','add','delete'])){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}    

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($projet = null)
    {	 	

    	//Menu et sous-menu
    	$session = $this->request->session();
    	$session->write('Progress.Menu','2');
    	$session->write('Progress.SousMenu','1');    	
    	
        $calendrierProjet = $this->CalendrierProjets->newEntity();
        if ($this->request->is('post')) {
    	//debug($this->request->data);die();
            $calendrierProjet = $this->CalendrierProjets->patchEntity($calendrierProjet, $this->request->data);
            
            //debug($calendrierProjet);die();
            
            if ($this->CalendrierProjets->save($calendrierProjet)) {
            	$projet = $calendrierProjet->projet_id;
                $this->Flash->success('L\'étape a bien été sauvegardée');
                return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de l\'étape');
            }
        }

		
        //On retrouve les infos du projet
        $this->loadModel('Projets');
        $projet = $this->Projets->find('all')
        ->where(['projets.id'=>$projet])->first();
        $this->set(compact('projet'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Calendrier Projet id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	//Menu et sous-menu
    	$session = $this->request->session();
    	$session->write('Progress.Menu','2');
    	$session->write('Progress.SousMenu','1'); 
    	
        $calendrierProjet = $this->CalendrierProjets->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calendrierProjet = $this->CalendrierProjets->patchEntity($calendrierProjet, $this->request->data);
            if ($this->CalendrierProjets->save($calendrierProjet)) {
                $this->Flash->success('L\'étape a bien été sauvegardée.');
                return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de l\'étape');
            }
        }
        
        $this->set(compact('calendrierProjet'));
        $this->set('_serialize', ['calendrierProjet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Calendrier Projet id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $calendrierProjet = $this->CalendrierProjets->get($id);
        if ($this->CalendrierProjets->delete($calendrierProjet)) {
            $this->Flash->success('L\'étape a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur lors de la suppression de l\'étape.');
        }
        return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);
    }
}
