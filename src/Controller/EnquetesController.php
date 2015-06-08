<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * EnqueteReponses Controller
 *
 * @property \App\Model\Table\EnqueteReponsesTable $EnqueteReponses
 */
class EnquetesController extends AppController
{

	public function initialize() {
		parent::initialize();
		//Menu et sous-menu
		$session = $this->request->session();
		$session->write('Progress.Menu','3');
		$session->write('Progress.SousMenu','1');
	}
	
	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {
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
    	
    	$query = $this->Enquetes->find('all')
    	->contain(['Fonctions', 'Demarches'])
    	->where(['Enquetes.demarche_id' => $id_demarche]);
    	
    	$queryMax = $this->Enquetes->find('all')
    	->where(['Enquetes.demarche_id' => $id_demarche]);
    	$dateMax = $queryMax->select(['max' => $query->func()->max('Enquetes.created')]);
    	
    	$this->set('enquetes', $this->paginate($query));
        $this->set('dateMax', $dateMax);
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
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	
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
        	$demarche_id = $resultat['demarche_id'];
        	$fonction_id = $resultat['fonction_id'];
			//Mise a jour des données
        	$enquete->service = $service;
        	$enquete->fonction_id = $fonction_id;
        	$enquete->demarche_id = $demarche_id;        	
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
        $fonctions = $this->Enquetes->Fonctions->find('list', ['limit' => 200]);
        $this->set(compact('enquete', 'questions', 'fonctions','id_demarche'));
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
