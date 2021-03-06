<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Etablissements Controller
 *
 * @property \App\Model\Table\EtablissementsTable $Etablissements
 */
class EtablissementsController extends AppController
{
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
    	
        $this->set('etablissements', $this->paginate($this->Etablissements));
        $this->set('_serialize', ['etablissements']);
    }

    /**
     * View method
     *
     * @param string|null $id Etablissement id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $etablissement = $this->Etablissements->get($id, [
            'contain' => ['Equipes']
        ]);
        $this->set('etablissement', $etablissement);
        $this->set('_serialize', ['etablissement']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $etablissement = $this->Etablissements->newEntity();
        if ($this->request->is('post')) {
            $etablissement = $this->Etablissements->patchEntity($etablissement, $this->request->data);
            if ($this->Etablissements->save($etablissement)) {
                $this->Flash->success('L\'établissement a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de l\'établissement.');
            }
        }
        $this->set(compact('etablissement'));
        $this->set('_serialize', ['etablissement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Etablissement id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $etablissement = $this->Etablissements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $etablissement = $this->Etablissements->patchEntity($etablissement, $this->request->data);
            if ($this->Etablissements->save($etablissement)) {
                $this->Flash->success('L\'établissement a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de l\'établissement.');
            }
        }
        $this->set(compact('etablissement'));
        $this->set('_serialize', ['etablissement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Etablissement id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $etablissement = $this->Etablissements->get($id);
        if ($this->Etablissements->delete($etablissement)) {
            $this->Flash->success('L\'établissement a bien été supprimé.');
        } else {
            $this->Flash->error('Erreur dans la suppression de l\'établissement.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
	public function search() {
		if ($this->request->is(['ajax'])) {
			
			$libelle = $this->request->data['libelle'];
            $etablissements = $this->Etablissements
            		->find('all')
            		->limit(20)
                    ->where(['libelle like ' => '%'.$libelle.'%']);
            $this->set('etablissements', $etablissements);
		}
	}
}
