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
		$this->loadComponent('Utilitaire');
		//Menu et sous-menu
 		$session = $this->request->session();
 		if($session->read('Equipe.Diagnostic') == 0) {
 			$session->write('Progress.Menu','2');
 			$session->write('Progress.SousMenu','2');
 		}
	}
	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {	
	
			//Demarche terminée
			if($session->read('Equipe.DemarcheEtat') == 1) return false;
			
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','edit','add','delete'])){
				return true;
			}
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
    	
    	//Vérification des éléments obigatoires du projet
    	$this->loadModel('Projets');
    	$projet = $this->Projets->find('all')
        ->where(['projets.demarche_id'=>$id_demarche])->first();
    	//intitulé du projet
    	if(strlen($projet->intitule) < 1 ) {
			$this->Flash->error('Merci de compléter le champ "Intitulé du projet" et d\'enregistrer les données');
            return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);    		
    	}
    	//Modalite de deploiement
    	if(strlen($projet->deploiement) < 1 ) {
    		$this->Flash->error('Merci de compléter le champ "Modalité de déploiement" et d\'enregistrer les données');
    		return $this->redirect(['controller'=>'Projets', 'action' => 'diagnostic_index']);
    	}
    	
    	//Message
    	$this->loadModel('Parametres');
    	$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilFonctionnement'])->first();
    	
    	//$evaluations = $this->Evaluations->find('all')->where(['demarche_id'=>$id_demarche])->order('ordre ASC');
    	$evaluations = $this->Evaluations->find('all')->where(['demarche_id'=>$id_demarche])->order('ordre ASC');
        $this->set('evaluations', $evaluations);
        $this->set('_serialize', ['evaluations']);
    	$this->set('message', $message);
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
        	$nomFichier = $this->Utilitaire->replaceCaracterespeciaux($d['file']['name']);        	
        	$destination = DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$nomFichier;        	
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
        
        //Message
        $this->loadModel('Parametres');
        $message = $this->Parametres->find('all')->where(['name' => 'MessageAideSyntheseFonctionnement'])->first();         
        
        $this->set(compact('evaluation','demarche_id','message'));
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
		$session = $this->request->session();
        $evaluation = $this->Evaluations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$d = $this->request->data;
        	
        	
        	//Test de la presence d'un fichier
        	if(isset($d['file']) && $d['file']['name'] === '' ) {
        		$this->Flash->error('Merci d\'ajouter un fichier.');
        		return $this->redirect(['action' => 'edit/'.$id]);
        	} 
        	//debug($d);die();
        	//Cas d'un nouveau fichier : CRM et Culture securite
        	if(isset($d['file']) && $d['file']['tmp_name'] != '') { 
        		// Il s'agit d'un nouveau fichier
	        	//Vérification de la présence
	        	if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$d['file']['name'])) {
	        		unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$d['file']['name']);
	        	}
	        	//Deplacement du nouveau 
	        	$nomFichier = $this->Utilitaire->replaceCaracterespeciaux($d['file']['name']);
	        	$destination = DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$nomFichier;
	        	move_uploaded_file($d['file']['tmp_name'], $destination);      	
        	} else if(isset($d['file_new']) && $d['file_new']['tmp_name'] != '') {        	
	        	//Cas d'une modification
        		//Suppression de l'ancien
        		if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$evaluation->file) && strlen($evaluation->file)>0) {
        			unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$evaluation->file);
        		}
        		//Deplacement du nouveau
        		$nomFichier = $this->Utilitaire->replaceCaracterespeciaux($d['file_new']['name']);
        		$destination = DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$nomFichier;
        		move_uploaded_file($d['file_new']['tmp_name'], $destination);
        	} else {
        		//Pas de nouveau fichier et pas de modification de fichier : modification des autres champs textes du formulaire 
        		$nomFichier = $evaluation->file ;
        	} 
        	// mise a jour des donnees
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
        //Message
        $this->loadModel('Parametres');
        $message = $this->Parametres->find('all')->where(['name' => 'MessageAideSyntheseFonctionnement'])->first();
        
        $this->set(compact('evaluation','message'));
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
		$session = $this->request->session();
        $this->request->allowMethod(['post', 'delete']);
        $evaluation = $this->Evaluations->get($id);
        
        //Si CRM Santé ou Culture Sécurité -> pas de suppression
        if( in_array($evaluation->name, ["CRM Santé","Culture Sécurité"])   ) {
        	$this->Flash->error('Vous ne pouvez pas supprimer les éléments "CRM Santé" ou "Culture Sécurité".');
        	return $this->redirect(['action' => 'index']);
        }
        $fichier = $evaluation->file;
        if ($this->Evaluations->delete($evaluation)) {
        	//Suppression du fichier
        	if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$fichier) && strlen($fichier)>0) {
        		unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$fichier);
        	}
            $this->Flash->success('L\'évaluation a bien été supprimée.');
        } else {
            $this->Flash->error('Erreur dans la suppression de l\'évaluation.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
