<?php
/**
 * Ce fichier fait partie du projet Pacte.
 *
 * Cette classe est le controlelur du macro-planning
 *
 * @author Anthony COUE <a.coue[@]has-sante.fr>
 * @package Controlleur
 * @property \App\Model\Table\CalendrierProjetsTable $CalendrierProjets
 * @copyright 2015 Haute Autorité de Santé (HAS)
 */

namespace App\Controller;

use App\Controller\AppController;

class CalendrierProjetsController extends AppController
{
	/**
	 * Méthode controllant l'autorisationd e l'utilisateur
	 * 
	 * @see \App\Controller\AppController::isAuthorized()
	 * @return boolean : True si les droits sont accordés ou false sinon 
	 */
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		// Si l'utilisateir est de profil equipe
		if( $session->read('Auth.User.role') === 'equipe') {	
			//Demarche terminée
			if($session->read('Equipe.DemarcheEtat') == 1) return false;			
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['edit','add','delete'])){
				return true;
			}
		}
		// Application des droit de la méthode parent
		return parent::isAuthorized($user);
	}    

	/**
	 * Méthode d'initialisation du controlleur
	 *
	 * @see \App\Controller\AppController::initialize()
	 * @return void
	 */
	
	public function initialize() {
		parent::initialize();		
	}
	
    /**
     * Methode d'ajout d'une étape dans le macro planning
     *
     * @param $projet|null Objet projet, null par défaut
     * @return void Redirection vers la vue Add une fois l'ajout effectué, ou vue erreur si echec.
     */
    public function add($projet = null) {	 	

    	//Menu et sous-menu
    	$session = $this->request->session();
    	//$session->write('Progress.Menu','2');
    	//$session->write('Progress.SousMenu','1');    	
    	
        $calendrierProjet = $this->CalendrierProjets->newEntity();
        if ($this->request->is('post')) {
            $calendrierProjet = $this->CalendrierProjets->patchEntity($calendrierProjet, $this->request->data);
            
            if ($this->CalendrierProjets->save($calendrierProjet)) {
            	$projet = $calendrierProjet->projet_id;
                $this->Flash->success('L\'étape a bien été sauvegardée');                
                return $this->redirect(['controller'=>'Projets', 'action' => 'calendrier']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de l\'étape');
            }
        }		
        //On retrouve les infos du projet
        $this->loadModel('Projets');
        $projet = $this->Projets->find('all')
        ->where(['projets.id'=>$projet])->first();
        $this->set(compact('projet'));
    }


    /**
     * Methode d'édition d'une étape dans le macro planning
     *
     * @param string|null $id id d'un Calendrier Projet
     * @return void Redirection vers la vue Edit une fois la modification effectuée, ou vue erreur si echec.
     * @throws \Cake\Network\Exception\NotFoundException Quand enregistrement n'est pas trouvé.
     */
    public function edit($id = null) {
    	//Menu et sous-menu
    	$session = $this->request->session();
    	
        $calendrierProjet = $this->CalendrierProjets->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calendrierProjet = $this->CalendrierProjets->patchEntity($calendrierProjet, $this->request->data);
            if ($this->CalendrierProjets->save($calendrierProjet)) {
                $this->Flash->success('L\'étape a bien été sauvegardée.');
                if($session->read('Equipe.Engagement') == '1') return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']); 
                else return $this->redirect(['controller'=>'Projets', 'action' => 'calendrier']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de l\'étape');
            }
        }
        
        $this->set(compact('calendrierProjet'));
        $this->set('_serialize', ['calendrierProjet']);
    }

    /**
     * Methode de suppression d'une étape dans le macro planning
     *
     * @param string|null $id Calendrier Projet id.
     * @return void Redirection vers la vue index.
     * @throws \Cake\Network\Exception\NotFoundException Quand enregistrement n'est pas trouvé.
     */
    public function delete($id = null) {
    	$session = $this->request->session();
        $this->request->allowMethod(['post', 'delete']);
        $calendrierProjet = $this->CalendrierProjets->get($id);
        if ($this->CalendrierProjets->delete($calendrierProjet)) {
            $this->Flash->success('L\'étape a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur lors de la suppression de l\'étape.');
        }

        //if($session->read('Equipe.Engagement') == '1') return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);
        //else return $this->redirect(['controller'=>'Projets', 'action' => 'calendrier']);
        return $this->redirect(['controller'=>'Projets', 'action' => 'calendrier']);
    }
}
