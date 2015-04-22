<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Phases Controller
 *
 * @property \App\Model\Table\PhasesTable $Phases
 */
class PhasesController extends AppController
{

	
	public function isAuthorized($user)
	{
	
		// Tous les role has peuvent voir les phases
		if ($this->request->action === 'view') {
			if (isset($user['role']) && $user['role'] === 'admin') return true;
		}
		if ($this->request->action === 'add') {
			if (isset($user['role']) && $user['role'] === 'admin') return true;
			else return false;
		}
		if ($this->request->action === 'delete') {
			if (isset($user['role']) && $user['role'] === 'admin') return true;
		}
		if ($this->request->action === 'edit') {
			if (isset($user['role']) && $user['role'] === 'admin') return true;
		}
		if ($this->request->action === 'index') {
			if (isset($user['role']) && $user['role'] === 'has') return true;
		}
	
		return parent::isAuthorized($user);
	}
	
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    	
    	
    	
    	//debug($this->request);
    	//die();

    	$session = $this->request->session();
    	$session->write('Progress.Menu','1');
    	$session->write('Progress.SousMenu','2');
    	
        $this->set('phases', $this->paginate($this->Phases));
        $this->set('_serialize', ['phases']);
    }

    /**
     * View method
     *
     * @param string|null $id Phase id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $phase = $this->Phases->get($id, [
            'contain' => []
        ]);
        $this->set('phase', $phase);
        $this->set('_serialize', ['phase']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $phase = $this->Phases->newEntity();
        if ($this->request->is('post')) {
            $phase = $this->Phases->patchEntity($phase, $this->request->data);
            if ($this->Phases->save($phase)) {
                $this->Flash->success('The phase has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La phase ne peut pas être sauvegardée.');
            }
        }
        $this->set(compact('phase'));
        $this->set('_serialize', ['phase']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Phase id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $phase = $this->Phases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phase = $this->Phases->patchEntity($phase, $this->request->data);
            if ($this->Phases->save($phase)) {
                $this->Flash->success('La phase a été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La phase ne peut pas être sauvegardée.');
            }
        }
        $this->set(compact('phase'));
        $this->set('_serialize', ['phase']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Phase id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $phase = $this->Phases->get($id);
        if ($this->Phases->delete($phase)) {
            $this->Flash->success('La phase a été supprimée.');
        } else {
            $this->Flash->error('La phase ne peut pas être supprimée.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
