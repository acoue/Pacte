<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Mesures Controller
 *
 * @property \App\Model\Table\MesuresTable $Mesures
 */
class MesuresController extends AppController
{
	public function initialize() {
		parent::initialize();
		//Menu et sous-menu
		$session = $this->request->session();
		$session->write('Progress.Menu','2');
		$session->write('Progress.SousMenu','4');
	}
	
	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','add','edit', 'delete','validate'])){
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
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	
    	 
    	$query = $this->Mesures->find('all')
    	->contain(['Demarches'])
    	->where(['Mesures.demarche_id' => $id_demarche]);    	
        $this->set('mesures', $this->paginate($query));
        $this->set('_serialize', ['mesures']);    	
    	
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
    	
        $mesure = $this->Mesures->newEntity();
        if ($this->request->is('post')) {
        	
        	//debug($this->request->data);die();
        	$d = $this->request->data;
        	$nomFichier = $d['file']['name'];
        	$destination = DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$nomFichier;
        	move_uploaded_file($d['file']['tmp_name'], $destination);
        	
        	$mesure->id = null;
        	$mesure->demarche_id = $d['demarche_id'];
        	$mesure->name = $d['name'];
        	$mesure->resultat = $d['resultat'];
        	$mesure->file = $nomFichier;
        	 
            if ($this->Mesures->save($mesure)) {
                $this->Flash->success('La mesure a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la mesure.');
            }
        }
        $this->set(compact('mesure','demarche_id'));
        $this->set('_serialize', ['mesure']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mesure id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$session = $this->request->session();
        $mesure = $this->Mesures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$d = $this->request->data;
        	
        	if($d['file'] === 'Modification' && $d['file_new']['name'] === '') {
        		$this->Flash->error('Merci d\'ajouter un fichier.');
        		return $this->redirect(['action' => 'edit/'.$id]);
        	}
        	 
        	if($d['file_new']['name'] === '') {
        		$mesure = $this->Mesures->patchEntity($mesure, $this->request->data);
        	} else { // Nouveau fichier
        	
        		//Suppression de l'ancien
        		if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$mesure->file) && strlen($mesure->file)>0) {
        			unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$mesure->file);
        		}
        		//Deplacement du nouveau
        		$nomFichier = $d['file_new']['name'];
        		$destination = DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$nomFichier;
        		move_uploaded_file($d['file_new']['tmp_name'], $destination);
        	
        		// mise a jour des donnees
        		$mesure->demarche_id = $d['demarche_id'];
        		$mesure->name = $d['name'];
        		$mesure->resultat = $d['resultat'];
        		$mesure->file = $nomFichier;
        	}
        	
            if ($this->Mesures->save($mesure)) {
                $this->Flash->success('La mesure a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de la mesure.');
            }
        }
        $this->set(compact('mesure'));
        $this->set('_serialize', ['mesure']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mesure id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$session = $this->request->session();
        $this->request->allowMethod(['post', 'delete']);
        $mesure = $this->Mesures->get($id);
        
        //Si Matrice de Maturité -> pas de suppression
        if($mesure->name === "Matrice de Maturité") {
        	$this->Flash->error('Vous ne pouvez pas supprimer la mesure "Matrice de Maturité".');
        	return $this->redirect(['action' => 'index']);
        }
        
        $fichier = $mesure->file;
        if ($this->Mesures->delete($mesure)) {
        	//Suppression du fichier
	        if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$fichier) && strlen($fichier)>0) {
	        	unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$fichier);
	        }
            $this->Flash->success('La mesure a bien été sauvegardée.');
        } else {
            $this->Flash->error('Erreur dans la suppression de la mesure.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function validate()
    {
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	 
    	//Vérification des éléments obigatoires de la phase Diagnostic > Evaluation a T0
    	$boolOk = true;
    	$message= "";
    	$this->loadModel('Mesures');
    	$evaluations = $this->Mesures->find('all')
    	->where(['Mesures.demarche_id'=>$id_demarche]);
    	
    	//Obligatoire resultat et file pour Matrice de Maturité
    	foreach ($evaluations as $eval){
    		if($eval->name == 'Matrice de Maturité') {
    			if(strlen($eval->resultat) <1) {
    				$boolOk = false;
    				$message = "Le résultat de la Matrice de Maturité doit être complétée.";
    				break;
    			}
    			if(strlen($eval->file) <1) {
    				$boolOk = false;
    				$message = "Merci d'associer un fichier à la Matrice de Maturité.";
    				break;
    			}    		
    		} else break;
    	}
    	 
    	if(!$boolOk) {
    		$this->Flash->error($message);
    		return $this->redirect(['controller'=>'mesures', 'action' => 'index']);
    	} else {
    		//Flag dans table demarche_phases => date_validation = now()
    		$this->loadModel('DemarchePhases');
    		$dp = $this->DemarchePhases->find('all')
    		->where(['DemarchePhases.demarche_id' => $id_demarche,'phase_id'=>'2'])
    		->first();
    		
    		$idDemarchePhase = $dp->id;
    		$demarchesPhasesTable = TableRegistry::get('DemarchePhases');
    		$demarchesPhase = $demarchesPhasesTable->get($idDemarchePhase);
    		
    		$demarchesPhase->date_validation = date('Y-m-d');
    		$demarchesPhasesTable->save($demarchesPhase);
    		
    		//Creation dans table demarche_phases pour la phase 2
    		$demarchesPhase = $demarchesPhasesTable->newEntity();
    		// Atribution des valeurs
    		$demarchesPhase->demarche_id = $id_demarche;
    		$demarchesPhase->phase_id = 3; //Entree dans la premiere phase
    		$demarchesPhase->date_entree = date('Y-m-d');
    		 
    		//Mise à jour de la session :
    		$session->write('Equipe.Engagement',1);
    		$session->write('Equipe.Diagnostic',1);
    		$session->write('Equipe.MiseEnOeuvre',0);
    		 
    		//Enregistrement
    		$demarchesPhasesTable->save($demarchesPhase);
    	}
    	 
    }
}
