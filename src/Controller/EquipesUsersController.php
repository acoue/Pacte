<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EquipesUsers Controller
 *
 * @property \App\Model\Table\EquipesUsersTable $EquipesUsers
 */
class EquipesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Equipes' => ['Etablissements'], 'Users']
        ];
        $this->set('equipesUsers', $this->paginate($this->EquipesUsers));
        $this->set('_serialize', ['equipesUsers']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipesUser = $this->EquipesUsers->newEntity();
        if ($this->request->is('post')) {
        	$data = $this->request->data;
        	
        	$ligneUnique = $this->EquipesUsers->find()
        									  ->where(['user_id'=>$data['user_id'],
        									  			'equipe_id' => $data['equipe_id']])
        									  ->count();
        	if($ligneUnique >0) {
        		$this->Flash->error('Ajout IMPOSSIBLE. Le couple Utilisateur / Equipe existe déjà');        		
        		return $this->redirect(['action' => 'index']);
        	} else {  
        		$equipesUser = $this->EquipesUsers->patchEntity($equipesUser, $data);
	            if ($this->EquipesUsers->save($equipesUser)) {
	                $this->Flash->success(__('La relation Utilisateur / Equipe a bien été sauvegardée'));
	                return $this->redirect(['action' => 'index']);
	            } else {
	                $this->Flash->error(__('The equipes user could not be saved. Please, try again.'));
	            }     
        	}
            
        }
        $equipes = $this->EquipesUsers->Equipes->find('list',['contain' => 'Etablissements']);
        $users = $this->EquipesUsers->Users->find('list')->where(['role <>'=>'equipe']);
        $this->set(compact('equipesUser', 'equipes', 'users'));
        $this->set('_serialize', ['equipesUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipes User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipesUser = $this->EquipesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipesUser = $this->EquipesUsers->patchEntity($equipesUser, $this->request->data);
            if ($this->EquipesUsers->save($equipesUser)) {
                $this->Flash->success(__('The equipes user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipes user could not be saved. Please, try again.'));
            }
        }
        $equipes = $this->EquipesUsers->Equipes->find('list',['contain' => 'Etablissements']);
        $users = $this->EquipesUsers->Users->find('list')->where(['role <> '=>'equipe','role <> ' => 'admin' ]);
        $this->set(compact('equipesUser', 'equipes', 'users'));
        $this->set('_serialize', ['equipesUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipes User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipesUser = $this->EquipesUsers->get($id);
        if ($this->EquipesUsers->delete($equipesUser)) {
            $this->Flash->success(__('The equipes user has been deleted.'));
        } else {
            $this->Flash->error(__('The equipes user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
