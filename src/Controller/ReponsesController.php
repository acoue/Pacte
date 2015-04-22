<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Reponses Controller
 *
 * @property \App\Model\Table\ReponsesTable $Reponses
 */
class ReponsesController extends AppController
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
            'contain' => ['Questions', 'Demarches']
        ];
        $this->set('reponses', $this->paginate($this->Reponses));
        $this->set('_serialize', ['reponses']);
    }

    /**
     * View method
     *
     * @param string|null $id Reponse id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reponse = $this->Reponses->get($id, [
            'contain' => ['Questions', 'Demarches']
        ]);
        $this->set('reponse', $reponse);
        $this->set('_serialize', ['reponse']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reponse = $this->Reponses->newEntity();
        if ($this->request->is('post')) {
            $reponse = $this->Reponses->patchEntity($reponse, $this->request->data);
            if ($this->Reponses->save($reponse)) {
                $this->Flash->success('The reponse has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The reponse could not be saved. Please, try again.');
            }
        }
        $questions = $this->Reponses->Questions->find('list', ['limit' => 200]);
        $demarches = $this->Reponses->Demarches->find('list', ['limit' => 200]);
        $this->set(compact('reponse', 'questions', 'demarches'));
        $this->set('_serialize', ['reponse']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reponse id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reponse = $this->Reponses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reponse = $this->Reponses->patchEntity($reponse, $this->request->data);
            if ($this->Reponses->save($reponse)) {
                $this->Flash->success('The reponse has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The reponse could not be saved. Please, try again.');
            }
        }
        $questions = $this->Reponses->Questions->find('list', ['limit' => 200]);
        $demarches = $this->Reponses->Demarches->find('list', ['limit' => 200]);
        $this->set(compact('reponse', 'questions', 'demarches'));
        $this->set('_serialize', ['reponse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reponse id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reponse = $this->Reponses->get($id);
        if ($this->Reponses->delete($reponse)) {
            $this->Flash->success('The reponse has been deleted.');
        } else {
            $this->Flash->error('The reponse could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
