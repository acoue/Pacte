<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Parametres Controller
 *
 * @property \App\Model\Table\ParametresTable $Parametres
 */
class ParametresController extends AppController
{
	
	public $paginate = [
			'order' => [
					'Parametres.name' => 'asc'
			]
	];
	
	public function isAuthorized($user)
	{	
		return parent::isAuthorized($user);
	}

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('RequestHandler');
	
	}
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('parametres', $this->paginate($this->Parametres));
        $this->set('_serialize', ['parametres']);
    }

    /**
     * View method
     *
     * @param string|null $id Parametre id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parametre = $this->Parametres->get($id);
        $this->set('parametre', $parametre);
        $this->set('_serialize', ['parametre']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parametre = $this->Parametres->newEntity();
        if ($this->request->is('post')) {
            $parametre = $this->Parametres->patchEntity($parametre, $this->request->data);
            if ($this->Parametres->save($parametre)) {
                $this->Flash->success('Le paramètre a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde du parametre.');
            }
        }
        $this->set(compact('parametre'));
        $this->set('_serialize', ['parametre']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parametre id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parametre = $this->Parametres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametre = $this->Parametres->patchEntity($parametre, $this->request->data);
            if ($this->Parametres->save($parametre)) {
                $this->Flash->success('Le paramètre a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde du parametre.');
            }
        }
        $this->set(compact('parametre'));
        $this->set('_serialize', ['parametre']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parametre id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parametre = $this->Parametres->get($id);
        if ($this->Parametres->delete($parametre)) {
            $this->Flash->success('Le paramètre a bien été supprimé.');
        } else {
            $this->Flash->error('Erreur lors de la suppression du parametre.');
        }
        return $this->redirect(['action' => 'index']);
    }
    

    public function search() {
    	if ($this->request->is(['ajax'])) {
    			
    		$libelle = $this->request->data['libelle'];
    		$parametres = $this->Parametres
    		->find('all')
    		->limit(20)
    		->where(['description like '=>'%'.$libelle.'%']);
    		$this->set('parametres', $parametres);
    		
    		//% or name like %% or description like %%
    	}
    }
    
}
