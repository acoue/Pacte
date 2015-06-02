<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EnqueteReponses Controller
 *
 * @property \App\Model\Table\EnqueteReponsesTable $EnqueteReponses
 */
class EnqueteReponsesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions', 'Demarches', 'Fonctions']
        ];
        $this->set('enqueteReponses', $this->paginate($this->EnqueteReponses));
        $this->set('_serialize', ['enqueteReponses']);
    }

    /**
     * View method
     *
     * @param string|null $id Enquete Reponse id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enqueteReponse = $this->EnqueteReponses->get($id, [
            'contain' => ['Questions', 'Demarches', 'Fonctions']
        ]);
        $this->set('enqueteReponse', $enqueteReponse);
        $this->set('_serialize', ['enqueteReponse']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enqueteReponse = $this->EnqueteReponses->newEntity();
        if ($this->request->is('post')) {
            $enqueteReponse = $this->EnqueteReponses->patchEntity($enqueteReponse, $this->request->data);
            if ($this->EnqueteReponses->save($enqueteReponse)) {
                $this->Flash->success('The enquete reponse has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The enquete reponse could not be saved. Please, try again.');
            }
        }
        $questions = $this->EnqueteReponses->Questions->find('list', ['limit' => 200]);
        $demarches = $this->EnqueteReponses->Demarches->find('list', ['limit' => 200]);
        $fonctions = $this->EnqueteReponses->Fonctions->find('list', ['limit' => 200]);
        $this->set(compact('enqueteReponse', 'questions', 'demarches', 'fonctions'));
        $this->set('_serialize', ['enqueteReponse']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Enquete Reponse id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enqueteReponse = $this->EnqueteReponses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enqueteReponse = $this->EnqueteReponses->patchEntity($enqueteReponse, $this->request->data);
            if ($this->EnqueteReponses->save($enqueteReponse)) {
                $this->Flash->success('The enquete reponse has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The enquete reponse could not be saved. Please, try again.');
            }
        }
        $questions = $this->EnqueteReponses->Questions->find('list', ['limit' => 200]);
        $demarches = $this->EnqueteReponses->Demarches->find('list', ['limit' => 200]);
        $fonctions = $this->EnqueteReponses->Fonctions->find('list', ['limit' => 200]);
        $this->set(compact('enqueteReponse', 'questions', 'demarches', 'fonctions'));
        $this->set('_serialize', ['enqueteReponse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Enquete Reponse id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enqueteReponse = $this->EnqueteReponses->get($id);
        if ($this->EnqueteReponses->delete($enqueteReponse)) {
            $this->Flash->success('The enquete reponse has been deleted.');
        } else {
            $this->Flash->error('The enquete reponse could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
