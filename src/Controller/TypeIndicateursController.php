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
                $this->Flash->success('Le type d\'indicateur a été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde du type d\'indicateur.');
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
                $this->Flash->success('Le type d\'indicateur a été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde du type d\'indicateur.');
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
            $this->Flash->success('Suppression du type d\'indicateur.');
        } else {
            $this->Flash->error('Erreur dans la suppression du type d\'indicateur.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
