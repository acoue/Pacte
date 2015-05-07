<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projets Controller
 *
 * @property \App\Model\Table\ProjetsTable $Projets
 */
class ProjetsController extends AppController
{
	public function initialize() {
		parent::initialize();
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','1');
	    $session->write('Progress.SousMenu','0');
	}

	
	public function isAuthorized($user)
	{			
		// Droits de tous les utilisateurs connectes sur les actions
		if(in_array($this->request->action, ['index','validate'])){
			return true;
		}		
		return parent::isAuthorized($user);
	}
	

    /**
     * Edit method
     *
     * @param string|null $id Projet id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function index()
    {
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	//On retrouve les infos du projet
        $projet = $this->Projets->find('all')
        ->where(['projets.demarche_id'=>$id_demarche])->first();
    	    	    	
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projet = $this->Projets->patchEntity($projet, $this->request->data);
            if ($this->Projets->save($projet)) {
                $this->Flash->success('Le projet a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde du projet.');
            }
        }

		//Recuperation des membres
        $this->loadModel('Membres');
        $membres = $this->Membres->find('all')
        ->contain(['Responsabilites'])
        ->where(['demarche_id' => $id_demarche,'comite'=>0]);
        
		//Recuperation des membres du ciomite de pilotage
        $this->loadModel('Membres');
        $membres_comites = $this->Membres->find('all')->where(['demarche_id' => $id_demarche,'comite'=>1]);

        //Recuperation des descriptions de l'equipe
        $this->loadModel('Descriptions');
        $descriptions = $this->Descriptions->find('all')
        ->contain(['Fonctions'])
        ->where(['projet_id' => $projet->id]);
        
        $this->set(compact('projet','membres','membres_comites','descriptions'));
        $this->set('_serialize', ['projet']);
    }
    
    public function validate()
    {
    	
    }
}