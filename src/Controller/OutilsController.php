<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Outils Controller
 *
 * @property \App\Model\Table\OutilsTable $Outils
 */
class OutilsController extends AppController
{
	
	public function isAuthorized($user)
	{
		return parent::isAuthorized($user);
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Phases']
        ];
        $this->set('outils', $this->paginate($this->Outils));
        $this->set('_serialize', ['outils']);
    }

    /**
     * View method
     *
     * @param string|null $id Outil id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $outil = $this->Outils->get($id, [
            'contain' => ['Phases']
        ]);
        $this->set('outil', $outil);
        $this->set('_serialize', ['outil']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {    	
        $outil = $this->Outils->newEntity();
        if ($this->request->is('post')) {
			
        	
        	debug($this->request->data); die();
        	
        	
        	$outil = $this->Outils->patchEntity($outil, $this->request->data);
            if ($this->Outils->save($outil)) {
                $this->Flash->success('The outil has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The outil could not be saved. Please, try again.');
            }
        }
        $phases = $this->Outils->Phases->find('list', ['limit' => 200]);
        $this->set(compact('outil', 'phases'));
        $this->set('_serialize', ['outil']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Outil id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $outil = $this->Outils->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $outil = $this->Outils->patchEntity($outil, $this->request->data);
            if ($this->Outils->save($outil)) {
                $this->Flash->success('The outil has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The outil could not be saved. Please, try again.');
            }
        }
        $phases = $this->Outils->Phases->find('list', ['limit' => 200]);
        $this->set(compact('outil', 'phases'));
        $this->set('_serialize', ['outil']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Outil id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $outil = $this->Outils->get($id);
        if ($this->Outils->delete($outil)) {
            $this->Flash->success('The outil has been deleted.');
        } else {
            $this->Flash->error('The outil could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
