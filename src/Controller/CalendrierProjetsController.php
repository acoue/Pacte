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
		// Droits de tous les utilisateurs connectes sur les actions
		if(in_array($this->request->action, ['edit','add','delete'])){
			return true;
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
    	
    	//On retrouve les infos du projet
    	$this->loadModel('Projets');
    	$projet = $this->Projets->find('all')
    	->where(['projets.id'=>$projet])->first();
    	
    	
        $calendrierProjet = $this->CalendrierProjets->newEntity();
        if ($this->request->is('post')) {
            $calendrierProjet = $this->CalendrierProjets->patchEntity($calendrierProjet, $this->request->data);
            if ($this->CalendrierProjets->save($calendrierProjet)) {
                $this->Flash->success('L\'étape a bien été sauvegardée');
                return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);
            } else {
                $this->Flash->error('L\'étape ne peut être sauvegardée');
            }
        }

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
        $calendrierProjet = $this->CalendrierProjets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calendrierProjet = $this->CalendrierProjets->patchEntity($calendrierProjet, $this->request->data);
            if ($this->CalendrierProjets->save($calendrierProjet)) {
                $this->Flash->success('The calendrier projet has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The calendrier projet could not be saved. Please, try again.');
            }
        }
        $projets = $this->CalendrierProjets->Projets->find('list', ['limit' => 200]);
        $this->set(compact('calendrierProjet', 'projets'));
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
            $this->Flash->success('The calendrier projet has been deleted.');
        } else {
            $this->Flash->error('The calendrier projet could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
