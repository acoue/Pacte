<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EnqueteQuestions Controller
 *
 * @property \App\Model\Table\EnqueteQuestionsTable $EnqueteQuestions
 */
class EnqueteQuestionsController extends AppController
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
        $this->set('enqueteQuestions', $this->paginate($this->EnqueteQuestions));
        $this->set('_serialize', ['enqueteQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Enquete Question id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enqueteQuestion = $this->EnqueteQuestions->get($id, [
            'contain' => []
        ]);
        $this->set('enqueteQuestion', $enqueteQuestion);
        $this->set('_serialize', ['enqueteQuestion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enqueteQuestion = $this->EnqueteQuestions->newEntity();
        if ($this->request->is('post')) {
            $enqueteQuestion = $this->EnqueteQuestions->patchEntity($enqueteQuestion, $this->request->data);
            if ($this->EnqueteQuestions->save($enqueteQuestion)) {
                $this->Flash->success('La question de l\'enquête a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la question de l\'enquête.');
            }
        }
        $this->set(compact('enqueteQuestion'));
        $this->set('_serialize', ['enqueteQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Enquete Question id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enqueteQuestion = $this->EnqueteQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enqueteQuestion = $this->EnqueteQuestions->patchEntity($enqueteQuestion, $this->request->data);
            if ($this->EnqueteQuestions->save($enqueteQuestion)) {
                $this->Flash->success('La question de l\'enquête a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la question de l\'enquête.');
            }
        }
        $this->set(compact('enqueteQuestion'));
        $this->set('_serialize', ['enqueteQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Enquete Question id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enqueteQuestion = $this->EnqueteQuestions->get($id);
        if ($this->EnqueteQuestions->delete($enqueteQuestion)) {
            $this->Flash->success('La question de l\'enquête a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur dans la suppression de la question de l\'enquête.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
