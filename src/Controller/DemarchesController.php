<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use CakePdf\Pdf\CakePdf;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;

/**
 * Demarches Controller
 *
 * @property \App\Model\Table\DemarchesTable $Demarches
 */
class DemarchesController extends AppController
{
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['index']);
	}

	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {	
			//Demarche terminée
			if($session->read('Equipe.DemarcheEtat') == 1) return false;
			
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['add','delete','view','edit','terminateDemarche'])){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}
	
	public function initialize()
	{
		parent::initialize();
	}
		
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Equipes']
        ];
        $this->set('demarches', $this->paginate($this->Demarches));
        $this->set('_serialize', ['demarches']);
    }

    /**
     * View method
     *
     * @param string|null $id Demarch id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $demarch = $this->Demarches->get($id, [
            'contain' => ['Equipes']
        ]);
        $this->set('demarch', $demarch);
        $this->set('_serialize', ['demarch']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
//     public function add()
//     {
//         $demarch = $this->Demarches->newEntity();
//         if ($this->request->is('post')) {
//             $demarch = $this->Demarches->patchEntity($demarch, $this->request->data);
//             if ($this->Demarches->save($demarch)) {
//                 $this->Flash->success('The demarch has been saved.');
//                 return $this->redirect(['action' => 'index']);
//             } else {
//                 $this->Flash->error('The demarch could not be saved. Please, try again.');
//             }
//         }
//         $equipes = $this->Demarches->Equipes->find('list', ['limit' => 200]);
//         $this->set(compact('demarch', 'equipes'));
//         $this->set('_serialize', ['demarch']);
//     }

    /**
     * Edit method
     *
     * @param string|null $id Demarch id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
//     public function edit($id = null)
//     {
//         $demarch = $this->Demarches->get($id);
//         if ($this->request->is(['patch', 'post', 'put'])) {
//             $demarch = $this->Demarches->patchEntity($demarch, $this->request->data);
//             if ($this->Demarches->save($demarch)) {
//                 $this->Flash->success('The demarch has been saved.');
//                 return $this->redirect(['action' => 'index']);
//             } else {
//                 $this->Flash->error('The demarch could not be saved. Please, try again.');
//             }
//         }
//         $equipes = $this->Demarches->Equipes->find('list', ['limit' => 200]);
//         $this->set(compact('demarch', 'equipes'));
//         $this->set('_serialize', ['demarch']);
//     }

    /**
     * Delete method
     *
     * @param string|null $id Demarch id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
//     public function delete($id = null)
//     {
//         $this->request->allowMethod(['post', 'delete']);
//         $demarch = $this->Demarches->get($id);
//         if ($this->Demarches->delete($demarch)) {
//             $this->Flash->success('The demarch has been deleted.');
//         } else {
//             $this->Flash->error('The demarch could not be deleted. Please, try again.');
//         }
//         return $this->redirect(['action' => 'index']);
//     }
    
    public function terminateDemarche() {
    
    	//On recupere l'identifiant de démarche
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	 
        //Vérification des éléments obigatoires de la phase MOE > Culture sécurité à T2
    	$boolOk = true;
    	$this->loadModel('Mesures');
    	$evaluations = $this->Mesures->find('all')
    	->where(['Mesures.demarche_id'=>$id_demarche,'name'=>'Culture Sécurité à T2']);
    	
    	//debug($evaluations); die();
    	//Obligatoire resultat et file pour Culture Securite à T2
   		foreach ($evaluations as $eval){
   			$tmp = $eval->name."<br />";
    		if($eval->name == 'Culture Sécurité à T2') {
    			if(strlen($eval->resultat) <1) {
    				$boolOk = false;
    				$message = "Le résultat de la Culture Securite à T2 doit être complété.";
    				break;
    			}
    			if(strlen($eval->file) <1) {
    				$boolOk = false;
    				$message = "Merci d'associer un fichier à la Culture Securite à T2.";
    				break;
    			}    		
    		} if($eval->name == 'Matrice de Maturité à T2') {
    			if(strlen($eval->resultat) <1) {
    				$boolOk = false;
    				$message = "Le résultat de la Matrice de Maturité à T2 doit être complété.";
    				break;
    			}
    			if(strlen($eval->file) <1) {
    				$boolOk = false;
    				$message = "Merci d'associer un fichier à la Matrice de Maturité à T2.";
    				break;
    			}    		
    			
    		} else break;
    	}

    	//debug($tmp); die();
    	if($boolOk){
    		//Cloture de la demarche
    		$demarche = $this->Demarches->get($id_demarche);
    		$demarche->statut = 1;
    		if($this->Demarches->save($demarche)) {
    			//Flag dans table demarche_phases => date_validation = now()
    			$this->loadModel('DemarchePhases');
    			$dp = $this->DemarchePhases->find('all')
    			->where(['DemarchePhases.demarche_id' => $id_demarche,'phase_id'=>'4'])
    			->first();
    			$idDemarchePhase = $dp->id;
    			$demarchesPhasesTable = TableRegistry::get('DemarchePhases');
    			$demarchesPhase = $demarchesPhasesTable->get($idDemarchePhase);
    			$demarchesPhase->date_validation = date('Y-m-d');
    			$demarchesPhasesTable->save($demarchesPhase);
    		
    			//Mise à jour de la session :
    			$session->write('Equipe.Evaluation',1);
    			$session->write('Equipe.DemarcheEtat',1);
    		
    		
    			//Envoie par mail d'un récap
    			$idequipe = $session->read('Equipe.Identifiant');
    		
    			//Recuperation des infos de l'equipe / etablissement
    			$equipe = $this->Equipes->find('all',['contain'=>'Etablissements'])->where(['Equipes.id'=>$idequipe])->first();
    			 
    			//informations sur le user de l'equipe
    			//$user = $this->Equipes->find('all',['contain' => 'Users'])->where(['Equipes.id'=>$idequipe])->first();
    			//$username = $user['user']['username'];
    			 
    			// 	    	//informations sur la démarches
    			// 	    	$this->loadModel('Demarches');
    			// 	    	$demarche = $this->Demarches->find('all')->where(['Demarches.equipe_id'=>$equipe->id])->first();
    		
    			//Etat des pahse de la demarche
    			$this->loadModel('DemarchePhases');
    			$phases = $this->DemarchePhases->find('all',['contain' => 'Phases'])
    			->where(['DemarchePhases.demarche_id'=>$demarche->id])
    			->order('phase_id ASC');
    			 
    			//Visualisation pure des informations
    			$this->loadModel('Projets');
    			$projet = $this->Projets->find('all')->where(['Projets.demarche_id'=>$demarche->id])->first();
    		
    			//Recuperation des infos des reponses
    			$this->loadModel('Reponses');
    			$reponses = $this->Reponses->find('all')
    			->contain(['Questions'])
    			->where(['Reponses.demarche_id' => $demarche->id])
    			->order(['Questions.ordre' => 'asc']);
    			 
    			//On retrouve les infos du projet
    			$projet = $this->Projets->find('all')
    			->where(['projets.demarche_id'=>$demarche->id])->first();
    			 
    			//Recuperation des membres
    			$this->loadModel('Membres');
    			$membres = $this->Membres->find('all')
    			->where(['Membres.demarche_id' => $demarche->id,'comite'=>0]);
    		
    			//Membres referents
    			$membres_referents = $this->Membres->find('all')
    			->contain(['Responsabilites'])
    			->where(['Membres.demarche_id' => $demarche->id,'comite'=>0,'responsabilite_id > ' => 1]);
    			 
    			//Recuperation des membres du comite de pilotage
    			$membres_comites = $this->Membres->find('all')->where(['demarche_id' => $demarche->id,'comite'=>1]);
    			 
    			//Recuperation des descriptions de l'equipe
    			$this->loadModel('Descriptions');
    			$descriptions = $this->Descriptions->find('all')
    			->contain(['Fonctions'])
    			->where(['Descriptions.projet_id' => $projet->id]);
    			 
    			//Recuperation des etape calendrier du projet
    			$this->loadModel('CalendrierProjets');
    			$calendriers = $this->CalendrierProjets->find('all')
    			->where(['projet_id' => $projet->id]);
    			 
    			//Recuperation des evaluation = fonctionnement d'equipe
    			$this->loadModel('Evaluations');
    			$evaluations = $this->Evaluations->find('all')
    			->where(['demarche_id'=>$demarche->id])->order('ordre ASC');
    		
    			//On retrouve les infos du plan d'action
    			$this->loadModel('PlanActions');
    			$planAction = $this->PlanActions->find('all')
    			->where(['demarche_id'=>$demarche->id])->first();
    			 
    			if($planAction && $planAction->is_has == 1 ) {
    				//On retrouve les infos du plan d'action
    				$this->loadModel('EtapePlanActions');
    				$etapePlanActions = $this->EtapePlanActions->find('all')
    				->contain(['PlanActions','TypeIndicateurs'])
    				->where(['PlanActions.demarche_id' => $demarche->id]);
    			} else $etapePlanActions = null;
    			 
    			//Recuperation des infos des mesures a t0
    			$this->loadModel('Mesures');
    			$mesures = $this->Mesures->find('all')
    			->where(['Mesures.demarche_id' => $demarche->id]);
    		
    		
    		
    			//Conception PDF
    			$CakePdf = new \CakePdf\Pdf\CakePdf();
    			$CakePdf->template('recapitulatif', 'visualisationExpert');
    			$CakePdf->title("Pacte - Etat");
    			$CakePdf->viewVars([
    					'equipe' => $equipe,
    					'demarche' => $demarche,
    					'projet' => $projet,
    					'reponses' => $reponses,
    					'phases' => $phases,
    					'membres' => $membres,
    					'membres_referents' => $membres_referents,
    					'membres_comites' => $membres_comites,
    					'descriptions' => $descriptions,
    					'calendriers' => $calendriers,
    					'evaluations' => $evaluations,
    					'planAction' => $planAction,
    					'etapePlanActions' => $etapePlanActions,
    					'mesures'  => $mesures
    			]);
    			 
    			//Write it to file directly
    			$filename = 'Recapitulatif_'.date('Ymd_His').''.mt_rand().'.pdf';
    			$CakePdf = $CakePdf->write(DATA . 'pdf' . DS . $filename);
    		
    		
    			if (ENV_APPLI === 'QUAL') {
    				$to = EMAIL_ADMIN;
    				$cc = $to;
    			} else {
    				$to = $cc = "";
    				//On récupere les email des membres referents (TO )+ du facilitateur (CC)
    				foreach ($membres_referents as $mr) {
    					if($mr->responsabilite_id == 2) $to.=$mr->email.";";
    					else if($mr->responsabilite_id == 3) $cc.=$mr->email.";";
    				}
    			}
    			//Envoie du mail
    			$this->loadModel('Parametres');
    			$from = $this->Parametres->find('all')->where(['name' => 'EmailContact'])->first();
    			$sujet = $this->Parametres->find()->where(['name' => 'SujetEmailRecapitulatifEngagement'])->first();
    			$content = $this->Parametres->find()->where(['name' => 'MessageRecapitulatifEngagement'])->first();
    			if(empty($sujet)) $sujet = "[PACTE] ";
    			else  $sujet = strip_tags($sujet['valeur']);
    		
    			$email = new Email('default');
    			$email->template('default')
    			->emailFormat('html')
    			->to($to)
    			->cc($cc)
    			->from(trim($from->valeur))
    			->subject($sujet)
    			->viewVars(['content' => $content['valeur']])
    			->attachments(DATA . 'pdf' . DS . $filename)
    			->send();
    		
    			//Suppression de la pj
    			unlink(DATA . 'pdf' . DS . $filename);
    		
    			$this->Flash->success('Votre démarche est désormais clôturée. Un email vient de vous être envoyé avec un récapitulatif.');
    		}else {
    			$this->Flash->error('Erreur dans la mise à jour de la démarche.');
    		}
    		
    	} else {
    		$this->Flash->error($message);
    	}
    	return $this->redirect(['controller'=>'Pages', 'action' => 'home']);
    }
    
    public function cloturerDemarche($id=null) {
    
    	if($id) {
    		//Cloture de la demarche
    		$demarche = $this->Demarches->get($id);
    		$demarche->statut = 1;
    		if($this->Demarches->save($demarche)) {
    			//Flag dans table demarche_phases => date_validation = now()
    			$this->loadModel('DemarchePhases');
    			$dp = $this->DemarchePhases->find('all')
    			->where(['DemarchePhases.demarche_id' => $id,'phase_id'=>'4'])
    			->first();
    			$idDemarchePhase = $dp->id;
    			$demarchesPhasesTable = TableRegistry::get('DemarchePhases');
    			$demarchesPhase = $demarchesPhasesTable->get($idDemarchePhase);
    			$demarchesPhase->date_validation = date('Y-m-d');
    			$demarchesPhasesTable->save($demarchesPhase);
    			$this->Flash->success('Phase clôturée avec succès');
    		}else {
    			$this->Flash->error('Erreur dans la clôture de la démarche.');
    		}
    	}    
    	return $this->redirect(['controller'=>'Pages', 'action' => 'home']);
    }
}
