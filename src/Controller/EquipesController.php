<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Equipes Controller
 *
 * @property \App\Model\Table\EquipesTable $Equipes
 */
class EquipesController extends AppController
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

    	//debug($this->request->data); die();
    	//Menu et sous-menu
    	$session = $this->request->session();
    	$session->write('Progress.Menu','1');
    	$session->write('Progress.SousMenu','1');

    	
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','1');
	    $session->write('Progress.SousMenu','1');
	    
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Equipe id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipe = $this->Equipes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipe = $this->Equipes->patchEntity($equipe, $this->request->data);
            if ($this->Equipes->save($equipe)) {
                $this->Flash->success('The equipe has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The equipe could not be saved. Please, try again.');
            }
        }
        $users = $this->Equipes->Users->find('list', ['limit' => 200]);
        $etablissements = $this->Equipes->Etablissements->find('list', ['limit' => 200]);
        $this->set(compact('equipe', 'users', 'etablissements'));
        $this->set('_serialize', ['equipe']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipe id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipe = $this->Equipes->get($id);
        if ($this->Equipes->delete($equipe)) {
            $this->Flash->success('The equipe has been deleted.');
        } else {
            $this->Flash->error('The equipe could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
