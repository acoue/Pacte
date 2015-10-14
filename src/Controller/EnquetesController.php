<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Expr\BinaryOp\Identical;

/**
 * EnqueteReponses Controller
 *
 * @property \App\Model\Table\EnqueteReponsesTable $EnqueteReponses
 */
class EnquetesController extends AppController
{

	public function initialize() {
		$this->loadComponent('EnqueteSatisfaction');
		parent::initialize();
		//Menu et sous-menu
// 		$session = $this->request->session();
// 		$session->write('Progress.Menu','3');
// 		$session->write('Progress.SousMenu','1');
	}
	
	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {	
			//Demarche terminée
			if($session->read('Equipe.DemarcheEtat') == 1) return false;
			
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','add','delete','view'])){
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
    	
    	//Requete principale
    	$query = $this->Enquetes->find('all')
    	->contain(['Fonctions', 'Demarches'])
    	->where(['Enquetes.demarche_id' => $id_demarche]);
    	
    	//Récupération de la campagne la plus élevée
    	$campagne = "";
    	if($query->count()) $campagne = $query->max('campagne')->campagne;
//debug($campagne);die();

    	$query = $this->Enquetes->find('all')
    	->contain(['Fonctions', 'Demarches'])
    	->where(['Enquetes.demarche_id' => $id_demarche,'campagne' => $campagne])
    	->order('Enquetes.created DESC');
    	
    	if($query->count()) $nbEnquete = $query->count();
    	else $nbEnquete = 0;
    	
    	$queryMax = $this->Enquetes->find('all')
    	->where(['Enquetes.demarche_id' => $id_demarche,'campagne' => $campagne]);
    	
    	$dateMax = $queryMax->select(['max' => $query->func()->max('Enquetes.created')]);    	

    	//Message
    	$this->loadModel('Parametres');
    	$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilEnqueteSatisfaction'])->first();
    	
    	if($nbEnquete > 0){
	    	//Graphique 1 et 2
	    	$this->loadModel('EnqueteReponses');
	    	$enquetes = $this->EnqueteReponses->find()
	    	->select(['Enquetes.campagne','EnqueteQuestions.name','EnqueteReponses.valeur'])
	    	->contain(['Enquetes','EnqueteQuestions'])
	    	->where(['Enquetes.demarche_id'=>$id_demarche,'EnqueteQuestions.type'=>'1','campagne'=>$campagne])
	    	->order('1,2');
	    	
	    	$tabReponse = $this->EnqueteSatisfaction->getEnqueteParCampagneReponseGraphique1($enquetes);
	    	$graphique1 = $this->EnqueteSatisfaction->getEnqueteParCampagneGraphique1($enquetes);
	    	$graphique2 = $this->EnqueteSatisfaction->getEnqueteParCampagneGraphique2($enquetes);
	    	
	    	// Graphique n°3 (TYPE 2) et le tableau de resultats
	    	$enquetes2 = $this->EnqueteReponses->find()
	    	->select(['Enquetes.campagne','EnqueteQuestions.name','EnqueteReponses.valeur'])
	    	->contain(['Enquetes','EnqueteQuestions'])
	    	->where(['Enquetes.demarche_id'=>$id_demarche,'EnqueteQuestions.type'=>'2','campagne'=>$campagne])
	    	->order('1,2');
	    	
	    	$graphique3 = $this->EnqueteSatisfaction->getEnqueteParCampagneGraphique3($enquetes2);
	    	$tabReponseType2 = $this->EnqueteSatisfaction->getEnqueteParCampagneReponseType2($enquetes2);
	    	 
	    	 
	    	$this->set(compact('tabReponse','tabReponseType2','graphique1','graphique2','graphique3'));
    	}
    	
    	$this->set('enquetes', $this->paginate($query));
        $this->set('dateMax', $dateMax);
        $this->set('nbEnquete',$nbEnquete);
    	$this->set('message', $message);	
        $this->set('campagne',$campagne);
        $this->set('_serialize', ['enquetes']); 
    	
    }

    /**
     * View method
     *
     * @param string|null $id Enquete Reponse id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
    	//Recuperation de la demarche
    	//$session = $this->request->session();
    	//$id_demarche = $session->read('Equipe.Demarche');
    	
        $enquete = $this->Enquetes->get($id, [
            'contain' => ['Demarches', 'Fonctions']
        ]);
        
        
        //Récupération des reponses
        $this->loadModel('EnqueteReponses');
        $reponses = $this->EnqueteReponses->find('all')
        								  ->contain(['EnqueteQuestions'])
        								  ->where( ['enquete_id'=>$id]);
        $this->set('enquete', $enquete);
        $this->set('reponses', $reponses);
        $this->set('_serialize', ['enquete','reponses']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	
    	
    	//Recuperation de la demarche
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
        $enquete = $this->Enquetes->newEntity();
        if ($this->request->is('post')) {
            
        	$resultat = $this->request->data;
        	//debug($resultat);die();  
        	$service = $resultat['service'];
        	$campagne = $resultat['campagne'];
        	$demarche_id = $resultat['demarche_id'];
        	$fonction_id = $resultat['fonction_id'];
			//Mise a jour des données
        	$enquete->service = $service;
        	$enquete->fonction_id = $fonction_id;
        	$enquete->demarche_id = $demarche_id;        
        	$enquete->campagne = $campagne; 	
        	$this->Enquetes->save($enquete);
        	$id_enquete = $enquete->id;
        	
        	
        	//Explode des reponses
        	$enqueteReponsesTable = TableRegistry::get('EnqueteReponses');
        	foreach ($resultat as $key => $value) {
        		if(!in_array($key,['demarche_id','service','fonction_id'])) {
        			$enqueteReponse =  $enqueteReponsesTable->newEntity();
        			$enqueteReponse->valeur = $value;
        			$enqueteReponse->question_id =  $key;
        			$enqueteReponse->enquete_id = $id_enquete;
        			$enqueteReponsesTable->save($enqueteReponse);
        		}        

        	}  
        	
            $this->Flash->success('L\'enquête de satisfaction a bien été sauvegardée.');
            return $this->redirect(['action' => 'index']);
        }

        //Récupération des questions
        $this->loadModel('EnqueteQuestions');
        $questions = $this->EnqueteQuestions->find('all')->order(['ordre' => 'asc']);
        $fonctions = $this->Enquetes->Fonctions->find('list');
        
        //Message
        $this->loadModel('Parametres');
        $message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilAjoutEnqueteSatisfaction'])->first();
         
        
        $this->set(compact('enquete', 'questions', 'fonctions','id_demarche','message'));
        $this->set('_serialize', ['enqueteReponse']);
    }

   
    /**
     * Delete method
     *
     * @param string|null $id Enquete Reponse id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquete = $this->Enquetes->get($id);
        if ($this->Enquetes->delete($enquete)) {
            $this->Flash->success('L\'enquête de satisfaction a bien été supprimée.');
        } else {
            $this->Flash->error('Erruer dans la suppression de l\'enquête de satisfaction.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
