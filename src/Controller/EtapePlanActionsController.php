<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EtapePlanActions Controller
 *
 * @property \App\Model\Table\EtapePlanActionsTable $EtapePlanActions
 */
class EtapePlanActionsController extends AppController
{
	
	public function initialize() {
		parent::initialize();
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
			if(in_array($this->request->action, ['index','add','edit', 'delete'])){
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
		
    	$this->loadModel('PlanActions');
    	$plan = $this->PlanActions->find()->where(['PlanActions.demarche_id' => $id_demarche])->first();

    	$this->paginate = ['order' => ['numero' => 'asc' ]];    	
    	$query = $this->EtapePlanActions->find('all')
    	->contain(['PlanActions','TypeIndicateurs'])
    	->where(['PlanActions.demarche_id' => $id_demarche]);

    	//Message
    	$this->loadModel('Parametres');
    	$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilPlanActionHas'])->first();
    	
    	$this->set('etapePlanActions', $this->paginate($query));
    	$this->set('_serialize', ['etapePlanActions']);
    	$this->set('plan', $plan->id);
    	$this->set('message', $message);
    	
    	    	
//         $this->set('etapePlanActions', $this->paginate($query));
//         $this->set('_serialize', ['etapePlanActions']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $etapePlanAction = $this->EtapePlanActions->newEntity();
        if ($this->request->is('post')) {
        	$d = $this->request->data;
        	//debug($d);die();
        	//On retrouve le plan d'action
        	$session = $this->request->session();
        	$id_demarche = $session->read('Equipe.Demarche');
        	//On retrouve les infos du projet
        	$this->loadModel('PlanActions');
        	$planAction = $this->PlanActions->find('all')
        	->where(['demarche_id'=>$id_demarche])->first();
        	
        	//On retrouve le numero
        	$etape = $this->EtapePlanActions->find()->where(['plan_action_id'=>$planAction->id])
        	->order('numero DESC')->first();
        	
			if(!empty($etape)) $numEtape = $etape->numero;
			else $numEtape=0;
			        	
        	$etapePlanAction->id = null;
        	$etapePlanAction->numero = $numEtape +1;
        	$etapePlanAction->name = $d['name'];
        	$etapePlanAction->pilote = $d['pilote'];
        	$etapePlanAction->mois = $d['mois'];
        	$etapePlanAction->annee = $d['annee'];
        	$etapePlanAction->etat = $d['etat'];
        	$etapePlanAction->modalite_suivi = $d['modalite_suivi'];
        	$etapePlanAction->resultat = $d['resultat'];
        	$etapePlanAction->indicateur = $d['indicateur'];
        	$etapePlanAction->type_indicateur_id = $d['type_indicateur_id'];        	
        	$etapePlanAction->plan_action_id = $planAction->id;
        	 
            if ($this->EtapePlanActions->save($etapePlanAction)) {
                $this->Flash->success('L\'étape du plan d\'action a bien été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde de l\'étape du plan d\action.');
            }
        }
        $typeIndicateurs = $this->EtapePlanActions->TypeIndicateurs->find('list', ['limit' => 200]);
        $this->set(compact('etapePlanAction', 'typeIndicateurs'));
        $this->set('_serialize', ['etapePlanAction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Etape Plan Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $etapePlanAction = $this->EtapePlanActions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	
            $etapePlanAction = $this->EtapePlanActions->patchEntity($etapePlanAction, $this->request->data);
            if ($this->EtapePlanActions->save($etapePlanAction)) {
                $this->Flash->success('L\'étape du plan d\'action a bien, été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de l\'étape du plan d\'action.');
            }
        }
        $typeIndicateurs = $this->EtapePlanActions->TypeIndicateurs->find('list', ['limit' => 200]);
        $planActions = $this->EtapePlanActions->PlanActions->find('list', ['limit' => 200]);
        $this->set(compact('etapePlanAction', 'typeIndicateurs', 'planActions'));
        $this->set('_serialize', ['etapePlanAction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Etape Plan Action id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $etapePlanAction = $this->EtapePlanActions->get($id);
        if ($this->EtapePlanActions->delete($etapePlanAction)) {
            $this->Flash->success('\'étape du plan d\'action supprimée.');
        } else {
            $this->Flash->error('Erreur lors de la suppression de l\'étape du plan d\'action.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
