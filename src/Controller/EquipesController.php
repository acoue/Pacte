<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use CakePdf\Pdf\CakePdf;

/**
 * Equipes Controller
 *
 * @property \App\Model\Table\EquipesTable $Equipes
 */
class EquipesController extends AppController
{
	public function initialize() {
		parent::initialize();		
	}
	
	
	public function isAuthorized($user)
	{		
		return parent::isAuthorized($user);
	}
	
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
    
    public function visualisation($type,$idequipe)
    {		
    	
    	//Recuperation des infos de l'equipe / etablissement
    	$equipe = $this->Equipes->find('all',['contain'=>'Etablissements'])->where(['Equipes.id'=>$idequipe])->first();
    	
    	//informations sur le user de l'equipe
    	$user = $this->Equipes->find('all',['contain' => 'Users'])->where(['Equipes.id'=>$idequipe])->first();    
    	$username = $user['user']['username'];	
    	 
    	
    	//informations sur la démarches
    	$this->loadModel('Demarches');
    	$demarche = $this->Demarches->find('all')->where(['Demarches.equipe_id'=>$equipe->id])->first();    	

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
    	
    	if($type ==1) { 
    		//generation d'un PDF avec les infos
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
    		$filename = '__AC_'.date('Ymd_His').''.mt_rand().'.pdf';
    		$CakePdf = $CakePdf->write(DATA . 'pdf' . DS . $filename);
    		
    		$this->autoRender = false;
    		$this->response->type('application/pdf');
    		$this->response->file(DATA . 'pdf' . DS . $filename, ['download' => true, 'name' => date('Y-m-d').'_Pacte_Récapitulatif.pdf']);
    		return $this->response;
    		
    	} 
    	$this->set(compact('equipe','demarche','projet','reponses','phases',
    							'membres','membres_referents','membres_comites','descriptions',
    							'calendriers','evaluations','planAction','etapePlanActions','mesures','username'));
    		 
    }
    
    
}
