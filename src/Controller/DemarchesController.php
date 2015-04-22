<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Demarches Controller
 *
 * @property \App\Model\Table\DemarchesTable $Demarches
 */
class DemarchesController extends AppController
{
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['index']);
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Equipes']
        ];
        $this->set('demarches', $this->paginate($this->Demarches));
        $this->set('_serialize', ['demarches']);
    }

    /**
     * View method
     *
     * @param string|null $id Demarch id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $demarch = $this->Demarches->get($id, [
            'contain' => ['Equipes']
        ]);
        $this->set('demarch', $demarch);
        $this->set('_serialize', ['demarch']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $demarch = $this->Demarches->newEntity();
        if ($this->request->is('post')) {
            $demarch = $this->Demarches->patchEntity($demarch, $this->request->data);
            if ($this->Demarches->save($demarch)) {
                $this->Flash->success('The demarch has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The demarch could not be saved. Please, try again.');
            }
        }
        $equipes = $this->Demarches->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('demarch', 'equipes'));
        $this->set('_serialize', ['demarch']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Demarch id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $demarch = $this->Demarches->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $demarch = $this->Demarches->patchEntity($demarch, $this->request->data);
            if ($this->Demarches->save($demarch)) {
                $this->Flash->success('The demarch has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The demarch could not be saved. Please, try again.');
            }
        }
        $equipes = $this->Demarches->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('demarch', 'equipes'));
        $this->set('_serialize', ['demarch']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Demarch id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $demarch = $this->Demarches->get($id);
        if ($this->Demarches->delete($demarch)) {
            $this->Flash->success('The demarch has been deleted.');
        } else {
            $this->Flash->error('The demarch could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
