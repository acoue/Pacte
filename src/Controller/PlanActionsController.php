<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PlanActions Controller
 *
 * @property \App\Model\Table\PlanActionsTable $PlanActions
 */
class PlanActionsController extends AppController
{
	public function initialize() {
		parent::initialize();
 		$this->loadComponent('Utilitaire');
		//Menu et sous-menu
 		$session = $this->request->session();
 		if($session->read('Equipe.Diagnostic') == 0) {
	 		$session->write('Progress.Menu','2');
 			$session->write('Progress.SousMenu','3');
 		}
 	}

	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {	
			//Demarche terminée
			if($session->read('Equipe.DemarcheEtat') == 1) return false;
			
		// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','add','edit', 'delete','printPlan'])){
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
    	
    	//Vérification des éléments obigatoires de la phase Diagnostic > Evaluation
    	$boolOk = true;
    	$message= "";
    	$this->loadModel('Evaluations');
    	$evaluations = $this->Evaluations->find('all')
    	->where(['Evaluations.demarche_id'=>$id_demarche]);
    	//Obligatoire synthese et file pour CRM Sante et Culture Securite
    	foreach ($evaluations as $eval){    		
    		if($eval->name == 'CRM Santé') {
    			if(strlen($eval->synthese) <1) {
    				$boolOk = false;
    				$message = "La synthèse du CRM Santé doit être complétée.";
    				break;
    			}
    			if(strlen($eval->file) <1) {
    				$boolOk = false;
    				$message = "Merci d'associer un fichier au CRM Santé.";
    				break;
    			}    			
    		} else if($eval->name == 'Culture Sécurité') {
    			if(strlen($eval->synthese) <1) {
    				$boolOk = false;
    				$message = "La synthèse de la Culture Sécurité doit être complétée.";
    				break;
    			}
    			if(strlen($eval->file) <1) {
    				$boolOk = false;
    				$message = "Merci d'associer un fichier à la Culture Sécurité.";
    				break;
    			}
    		} else break;
    	}
    	
    	if(!$boolOk) {
        	$this->Flash->error($message);
        	return $this->redirect(['controller'=>'evaluations', 'action' => 'index']);    		
    	}
    	    	
    	//On retrouve les infos du plan d'action
    	$planAction = $this->PlanActions->find('all')
    	->where(['demarche_id'=>$id_demarche])->first();  	
    	

    	//Message
    	$this->loadModel('Parametres');
    	$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilChoixPlanAction'])->first();
    	$messageAvertissement = $this->Parametres->find('all')->where(['name' => 'MessageAvertissementChoixPlanAction'])->first();
    	 
    	
    	//debug( $planAction);die();
        $this->set(compact('planAction'));
        $this->set('_serialize', ['planAction']);
    	$this->set('message', $message);
    	$this->set('messageAvertissement',$messageAvertissement);
//debug($planAction);die();
        if(! empty($planAction)) {
        	if($planAction->is_has == 0 ) return $this->redirect(['controller'=>'PlanActions','action' => 'edit/'.$planAction->id]);
        	else return $this->redirect(['controller'=>'EtapePlanActions','action' => 'index']);   
        }
        
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planAction = $this->PlanActions->newEntity();
  
        if ($this->request->is('post')) {
        	//debug($this->request->data);die();
    		$session = $this->request->session();
    		$id_demarche = $session->read('Equipe.Demarche'); 	
        	$planAction->id = null;
        	$planAction->demarche_id = $id_demarche;
        	$planAction->is_has = $this->request->data['is_has'];
        	 
        	if ($this->PlanActions->save($planAction)) {
        		$this->Flash->success('Le plan d\'action a bien été créé.');
        		
        		if($session->read('Equipe.Diagnostic') == '0') {        		
        			return $this->redirect(['action' => 'index']);
        		} else {
        			
        			if($planAction->is_has == 0 ) return $this->redirect(['action' => 'edit/'.$planAction->id]);
        			else return $this->redirect(['controller'=>'EtapePlanActions','action' => 'index']);   			
        			
        		}
        	} else {
        		$this->Flash->error('Erreur dans la création du  plan d\'action.');
        	}
        }
        $this->set(compact('planAction'));
        $this->set('_serialize', ['planAction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$session = $this->request->session();
        $planAction = $this->PlanActions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$d = $this->request->data;
        	

        	//Test de la presence d'un fichier
        	if($d['file']['name'] === '' ) {
        		$this->Flash->error('Merci d\'ajouter un fichier.');
        		return $this->redirect(['action' => 'edit/'.$id]);
        	}
        	 
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
        		if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$planAction->file) && strlen($planAction->file)>0) {
        			unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$planAction->file);
        		}
        		//Deplacement du nouveau
        		$nomFichier = $this->Utilitaire->replaceCaracterespeciaux($d['file_new']['name']); 
        		$destination = DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$nomFichier;
        		move_uploaded_file($d['file_new']['tmp_name'], $destination);
        	} else {
        		//Pas de nouveau fichier et pas de modification de fichier : modification des autres champs textes du formulaire
        		$nomFichier = $planAction->file ;
        	}
        	
        	$planAction->name = $d['name'];
        	$planAction->file = $nomFichier;
        	$planAction->is_has = 0;
        	
        	 
        	if ($this->PlanActions->save($planAction)) {
        		$this->Flash->success('Le plan d\'action a bien été sauvegardé.');
        		
        		if($session->read('Equipe.Diagnostic') == '0') {
        			return $this->redirect(['controller'=>'Mesures','action' => 'index']);
        		} else {        			 
        			return $this->redirect(['controller'=>'Pages','action' => 'home']);        			 
        		} 
        		
        	} else {
        		$this->Flash->error('Erreur dans la sauvegarde du plan d\'action.');
        	}
        }
        $this->set(compact('planAction'));
        $this->set('_serialize', ['planAction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan Action id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
    	
		$session = $this->request->session();
        //$this->request->allowMethod(['post', 'delete']);
        $planAction = $this->PlanActions->get($id);

        //suppression du fichier
        if($planAction->is_has == 0) {
        	if(strlen($planAction->file) > 0) {
        		if(file_exists(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$planAction->file)) {
        			unlink(DATA.'userDocument'.DS.$session->read('Auth.User.username').DS.$planAction->file);
        		}
        	}        	
        }
        
        if ($this->PlanActions->delete($planAction)) {
            $this->Flash->success('Le plan d\'action a bien été supprimé.');
        } else {
            $this->Flash->error('Erreur dans la suppression du plan d\'action.');
        }
        
        return $this->redirect(['action' => 'index']);
    }
    
    public function printPlan($id = null) {

    	//On retrouve les infos du plan d'action
    	$this->loadModel('EtapePlanActions');
    	$etapePlanActions = $this->EtapePlanActions->find('all')
    	->contain(['PlanActions','TypeIndicateurs'])
    	->where(['PlanActions.id' => $id]);
    	
    	//generation d'un PDF avec les infos
    	//Conception PDF
    	$CakePdf = new \CakePdf\Pdf\CakePdf();
    	$CakePdf->template('recapitulatif', 'visualisationPlan');
    	$CakePdf->title("Pacte - Etat");
    	$CakePdf->viewVars([
    			'etapePlanActions' => $etapePlanActions
    	]);
    	
    	 
    	//Write it to file directly
    	$filename = '__AC_'.date('Ymd_His').''.mt_rand().'.pdf';
    	$CakePdf = $CakePdf->write(DATA . 'pdf' . DS . $filename);
    	
    	$this->autoRender = false;
    	$this->response->type('application/pdf');
    	$this->response->file(DATA . 'pdf' . DS . $filename, ['download' => true, 'name' => date('Y-m-d').'_Pacte_Récapitulatif.pdf']);
    	return $this->response;
    }
}
