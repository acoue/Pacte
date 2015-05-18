<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Indicateurs Controller
 *
 * @property \App\Model\Table\IndicateursTable $Indicateurs
 */
class TypeIndicateursController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('typeIndicateurs', $this->paginate($this->TypeIndicateurs));
        $this->set('_serialize', ['typeIndicateurs']);
    }

    /**
     * View method
     *
     * @param string|null $id Indicateur id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeIndicateur = $this->TypeIndicateurs->get($id, [
            'contain' => ['EtapePlanActions']
        ]);
        $this->set('typeIndicateur', $typeIndicateur);
        $this->set('_serialize', ['typeIndicateur']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeIndicateur = $this->TypeIndicateurs->newEntity();
        if ($this->request->is('post')) {
            $typeIndicateur = $this->TypeIndicateurs->patchEntity($typeIndicateur, $this->request->data);
            if ($this->TypeIndicateurs->save($typeIndicateur)) {
                $this->Flash->success('The indicateur has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The indicateur could not be saved. Please, try again.');
            }
        }
        $this->set(compact('typeIndicateur'));
        $this->set('_serialize', ['typeIndicateur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Indicateur id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeIndicateur = $this->TypeIndicateurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeIndicateur = $this->TypeIndicateurs->patchEntity($typeIndicateur, $this->request->data);
            if ($this->TypeIndicateurs->save($typeIndicateur)) {
                $this->Flash->success('The indicateur has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The indicateur could not be saved. Please, try again.');
            }
        }
        $this->set(compact('typeIndicateur'));
        $this->set('_serialize', ['typeIndicateur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Indicateur id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeIndicateur = $this->TypeIndicateurs->get($id);
        if ($this->TypeIndicateurs->delete($typeIndicateur)) {
            $this->Flash->success('The indicateur has been deleted.');
        } else {
            $this->Flash->error('The indicateur could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
