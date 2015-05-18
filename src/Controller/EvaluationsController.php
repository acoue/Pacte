<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Evaluations Controller
 *
 * @property \App\Model\Table\EvaluationsTable $Evaluations
 */
class EvaluationsController extends AppController
{
	public function initialize() {
		parent::initialize();
		//Menu et sous-menu
		$session = $this->request->session();
		$session->write('Progress.Menu','2');
		$session->write('Progress.SousMenu','2');
	}
	
	public function isAuthorized($user)
	{
		// Droits de tous les utilisateurs connectes sur les actions
		if(in_array($this->request->action, ['index','edit','add','delete'])){
			return true;
		}
		return parent::isAuthorized($user);
	}   
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    	//Recuperation de la demarche
		$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	
    	$evaluations = $this->Evaluations->find('all')->where(['demarche_id'=>$id_demarche])->order('name ASC');
    	
        $this->set('evaluations', $evaluations);
        $this->set('_serialize', ['evaluations']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$session = $this->request->session();
    	$demarche_id = $session->read('Equipe.Demarche');
        $evaluation = $this->Evaluations->newEntity();
        if ($this->request->is('post')) {
        	
        	//debug($this->request->data);die();
        	$d = $this->request->data;
        	$nomFichier = $d['file']['name'];
        	$destination = DATA.'userDocument'.DS.$nomFichier;
        	move_uploaded_file($d['file']['tmp_name'], $destination);
        	 
        	$evaluation->id = null;
        	$evaluation->demarche_id = $d['demarche_id'];
        	$evaluation->name = $d['name'];
        	$evaluation->synthese = $d['synthese'];
        	$evaluation->file = $nomFichier;        	
        	
            if ($this->Evaluations->save($evaluation)) {
                $this->Flash->success('L\'évaluation a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de l\'évaluation.');
            }
        }
        $this->set(compact('evaluation','demarche_id'));
        $this->set('_serialize', ['evaluation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evaluation id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evaluation = $this->Evaluations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$d = $this->request->data;
        	
        	if($d['file_new']['name'] === '') {
        		$evaluation = $this->Evaluations->patchEntity($evaluation, $this->request->data);        		
        	} else { // Nouveau fichier	
	        	//Suppression de l'ancien
	        	if(file_exists(DATA.'userDocument'.DS.$evaluation->file))unlink(DATA.'userDocument'.DS.$evaluation->file);
	        	//Deplacement du nouveau 
	        	$nomFichier = $d['file_new']['name'];
	        	$destination = DATA.'userDocument'.DS.$nomFichier;
	        	move_uploaded_file($d['file_new']['tmp_name'], $destination);      	
	        	
	        	// mise a jour des donnees
	        	$evaluation->demarche_id = $d['demarche_id'];
	        	$evaluation->name = $d['name'];
	        	$evaluation->synthese = $d['synthese'];
	        	$evaluation->file = $nomFichier;
        	} 
        	
            if ($this->Evaluations->save($evaluation)) {
                $this->Flash->success('L\'évaluation a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de l\'évaluation.');
            }
        }
        $demarches = $this->Evaluations->Demarches->find('list', ['limit' => 200]);
        $this->set(compact('evaluation', 'demarches'));
        $this->set('_serialize', ['evaluation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evaluation id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evaluation = $this->Evaluations->get($id);
        if ($this->Evaluations->delete($evaluation)) {
            $this->Flash->success('L\'évaluation a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur dans la suppression de l\'évaluation.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
