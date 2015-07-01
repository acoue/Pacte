<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fonctions Controller
 *
 * @property \App\Model\Table\FonctionsTable $Fonctions
 */
class FonctionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('fonctions', $this->paginate($this->Fonctions));
        $this->set('_serialize', ['fonctions']);
    }

    /**
     * View method
     *
     * @param string|null $id Fonction id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fonction = $this->Fonctions->get($id);
        $this->set('fonction', $fonction);
        $this->set('_serialize', ['fonction']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fonction = $this->Fonctions->newEntity();
        if ($this->request->is('post')) {
            $fonction = $this->Fonctions->patchEntity($fonction, $this->request->data);
            if ($this->Fonctions->save($fonction)) {
                $this->Flash->success('La fonction a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la fonction.');
            }
        }
        $this->set(compact('fonction'));
        $this->set('_serialize', ['fonction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fonction id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fonction = $this->Fonctions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonction = $this->Fonctions->patchEntity($fonction, $this->request->data);
            if ($this->Fonctions->save($fonction)) {
                $this->Flash->success('La fonction a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la fonction.');
            }
        }
        $this->set(compact('fonction'));
        $this->set('_serialize', ['fonction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fonction id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fonction = $this->Fonctions->get($id);
        if ($this->Fonctions->delete($fonction)) {
            $this->Flash->success('La fonction a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur dans la suppression de la fonction.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
