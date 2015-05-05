<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Event\Event;

/**
 * Inscriptions Controller
 *
 * @property \App\Model\Table\InscriptionsTable $Inscriptions
 */
class InscriptionsController extends AppController
{
	// Actions publiques 
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['index','add','create', 'validate', 'validate_refus']);
	}
	
//     public function isAuthorized($user)
//     {
// 		return parent::isAuthorized($user);
//     }​
	
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Securite');
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
    	$session->write('Progress.Menu','0');
    	$session->write('Progress.SousMenu','0');

    	//Validation du formulaire pour rechercher les etablissements
    	if ($this->request->is('post')){
    		    	
    		$term = '%'.$this->request->data['numero_demarche'].'%';
    		$this->loadModel('Etablissements');
    		$etablissements = $this->Etablissements->find('all')->where([' numero_demarche LIKE' => $term]);
    		$this->set(compact('etablissements'));
    		// On ecris en session les infos saisies	    	
	    	$session->write('Engagement.Date',$this->request->data['date_engagement']);
			$session->write('Engagement.Numero_Demarche',$this->request->data['numero_demarche']);
			// On redirige
    		$this->render('/Inscriptions/add');
    	} 
    	
    	if($this->request->is('get') && $session->check('Engagement.Id_Etablissement')) {
    		$session->delete('Engagement.Id_Etablissement');
    		$term = '%'.$session->read('Engagement.Numero_Demarche').'%';
    		$this->loadModel('Etablissements');
    		$etablissements = $this->Etablissements->find('all')->where([' numero_demarche LIKE' => $term]);
    		$this->set(compact('etablissements'));  
			// On redirige
    		$this->render('/Inscriptions/add');	    		
    	}
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
	    $session->write('Progress.Menu','0');
	    $session->write('Progress.SousMenu','0');
	    	
    	if ($this->request->is('post')) {
    		//On retrouve les infos etablissement
    		$this->loadModel('Etablissements');
    		$etablissement = $this->Etablissements->find('all')->where(['id' => $this->request->data['etablissement_id']])->first();
			$this->set(compact('etablissement'));
	    	// On ecris en session les infos saisies	    	
	    	$session->write('Engagement.Id_Etablissement',$etablissement->id);
			$session->write('Engagement.Finess',$etablissement->finess);
			$session->write('Engagement.Raison_Sociale',$etablissement->libelle);
			$session->write('Engagement.Libelle_Equipe',$this->request->data['libelle_equipe']);
		    $this->redirect(['controller' => 'Inscriptions', 'action' => 'Create']);
    	}
    }
    

    /**
     * Validate method
     *
     * @return void .
     */
    public function validate($etat = null)
    {    	   	
		//debug($etat);die();
    	//Menu et sous-menu
    	$session = $this->request->session();
    	$session->write('Progress.Menu','0');
    	$session->write('Progress.SousMenu','0');
    	
    	//Validation
    	if ($this->request->is(['post', 'put'])) {
    		   		
    		// On retrouve lesinfos de l'inscription 
    		$this->loadModel('Inscriptions');
    		$inscription = $this->Inscriptions->find('all')->where(['id' => $session->read('Engagement.id_Inscription')])->first(); 		
    		
     		$boolOk = true;
    		
     		//Creation du User    			
     		   		
     		$password = $this->Securite->getPassword();
    		$token = $this->Securite->getToken();
     		
     		/* A FAIRE 
     		 * 
     		 * ANNEE_NUMDEMARCHE_INCREMEMENT
     		 * 
     		 * */
     		$increment = 1;
     		$username = date('Y')."_".$session->read('Engagement.Numero_Demarche')."_".$increment;
    		
     		//Stockage en base de donnees
     		$usersTable = TableRegistry::get('Users');  		 
    		$user = $usersTable->newEntity();    		
    		// Atribution des valeurs
			$user->id = null;
    		$user->username = $username;    
    		$user->password = $password;     
    		$user->token = $token;   	
    		$user->role = "equipe";    			
    		//Enregistrement
    		if($usersTable->save($user)) $id_User = $user->id;
    		else $boolOk = false;

    		if($boolOk) {
    			//Creation Equipe
    			$equipesTable = TableRegistry::get('Equipes');
    			$equipe = $equipesTable->newEntity();
    			// Atribution des valeurs
    			$equipe->name = $inscription->name;
    			$equipe->user_id = $id_User;
    			$equipe->etablissement_id = $session->read('Engagement.Id_Etablissement');
    			//Enregistrement
    			if($equipesTable->save($equipe)) $id_equipe = $equipe->id;
    			else $boolOk = false;
    		}
    		
    		if($boolOk) {
	            //Creation de la démarche
    			$demarchesTable = TableRegistry::get('Demarches');
    			$demarche = $demarchesTable->newEntity();
    			// Atribution des valeurs
    			$demarche->name = $session->read('Engagement.Libelle_Equipe');
    			$demarche->date_engagement = $inscription->date_engagement;
    			$demarche->score = $inscription->score;
    			$demarche->situation_crise = $inscription->situation_crise;
    			$demarche->restructuration = $inscription->restructuration;
    			$demarche->equipe_id = $id_equipe;
    			//Enregistrement
    			if($demarchesTable->save($demarche)) $id_demarche = $demarche->id;
    			else $boolOk = false;
    		}
    		
    		if($boolOk) {
    			//Recuperation reponses
    			$reponse_resultat = $inscription->reponses;
    			//Creation reponses
    			$reponsesTable = TableRegistry::get('Reponses');
    			$tab_reponse = explode('#', $reponse_resultat);
    			//debug($reponse_resultat);
    			//die();
    			
    			foreach ($tab_reponse as $value){
    				if(strlen($value) >0){
	    				$reponse = $reponsesTable->newEntity();
	    				$tab_tmp = explode('-', $value);
	    				$reponse->libelle = $tab_tmp[1];
	    				$reponse->question_id = $tab_tmp[0];
	    				$reponse->demarche_id = $id_demarche;
	    				unset($tab_tmp);
	    				if($reponsesTable->save($reponse)) $boolOk = true;
    					else $boolOk = false;
    				}
    			}
    		}
    		
    		if($boolOk) {
    			//Suppression de la table inscription
    			$entity = $this->Inscriptions->get($inscription->id);
    			if($this->Inscriptions->delete($entity)) $boolOk = true;
    			else $boolOk = false;
    		}
    		
    		if($boolOk) {
	            //Envoi du mail
    			//Enregistrement de l'ID en session en cas de retour
    			$link = ['controller'=>'users', 'action' => 'activate', $user->id."-".$user->token, '_full' => true];
    			 
    			$email = new Email('default');
    			$email->template('inscription')
    			->emailFormat('html')
    			->to($this->request->data('mail'))
    			->from('refex@has-sante.fr')
    			->subject('[Pacte] Validation de votre inscription')
    			->viewVars(['login'=>$username,'mdp'=>$password,'link'=>$link])
    			->send();
    			
	    		//Redirection
    			$message = "Inscription terminée, un mail va vous être envoyé pour terminer la validation.";
    			$this->set(compact('message'));
    			$this->render('validate_accept');
    		} else {
    			$message = "une erreur s'est produite lors de l'inscription.";
    			$this->set(compact('message'));
    			$this->render('validate_refus');
    		}
    	
    	}
    	
    	if(isset($etat)) {
    		if($etat == '0') {
    			$session = $this->request->session();
    			$session->destroy();
    			//Message
    			$message = "Vous ne souhaitez pas poursuivre";
    			$this->set(compact('message'));
    			$this->render('validate_refus');
    		} else if($etat == '2' ) { //Impossible car niveau de certification de l'ES bloquant
    			$session = $this->request->session();
    			$session->destroy();
    			//Message     			
    			$message = "Le niveau de certification de l'établissement ne permet pas de continuer la démarche Pacte";
    			$this->set(compact('message'));
    			$this->render('validate_refus');
    		} else if($etat == '3') { //Erreur sur l'etude du questionnaire
    			$session = $this->request->session();
    			$session->destroy();
    			//Message
    			$message = "Une erreur s'est produite lors de l'étude du formulaire";
    			$this->set(compact('message'));
    			$this->render('validate_refus');
    		} else {
    			$message = "une erreur s'est produite";
    			$this->set(compact('message'));
    			$this->render('validate_refus');
    		}
    	}
    }   
   
    
    /**
     * Create method
     *
     * @return void Redirects on successful create, renders view otherwise.
     */
    public function create()
    {    	
    	//debug($this->request->data); die();
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $session->write('Progress.Menu','0');
	    $session->write('Progress.SousMenu','0');
		

	    if ($this->request->is(['post', 'put'])) {
	    		    	
	    	//debug($this->request->data); die();
	    	$boolInscription = true;
	    	// Calculer le score
	    	$score = 0;
	    	$situation_crise = 1;
	    	$restructuration = 1;
	    	$reponses = "";
	    	$resultat = $this->request->data;
	    	
	    	//Explode des reponses
	    	foreach ($resultat as $key => $value) {
	    		if($key != "etablissement_id") {
	    			$num = substr($key, 2);
	    			
	    			if($num == 9) { //Situation de crise -> question id : 9
	    				if($value === 'N') {
	    					$situation_crise = 0; 
	    					$score = $score + 1;
	    				}
	    			} else if($num == 10) { // Restructuration -> question id : 10
	    				if($value === 'N') {
	    					$restructuration = 0; 
	    					$score = $score + 1;
	    				}
	    			}
					else if($value === 'O') $score = $score + 1;					
	    			$reponses .= $num."-".$value."#";
	    		}
	    		
	    	}
	    	
	    	//Recuperation des valeurs en session
    		$session = $this->request->session();
    		//recuperation des donnees
	    	if($session->check('Engagement.Libelle_Equipe')) $name = $session->read('Engagement.Libelle_Equipe');
	    	else $boolInscription = false;
	    	if($session->check('Engagement.Date')) $date_engagement = $session->read('Engagement.Date');
	    	else $boolInscription = false;	    	
	    	if($session->check('Engagement.Numero_Demarche')) $numero_demarche = $session->read('Engagement.Numero_Demarche');
	    	else $boolInscription = false;
	    	if($session->check('Engagement.Id_Etablissement')) $etablissement = $session->read('Engagement.Id_Etablissement');
	    	else $boolInscription = false;	    
	    		
		    if($boolInscription) {
		    	//Stockage en base de donnees		    	
		    	$inscriptionsTable = TableRegistry::get('Inscriptions');
		    	
				//Si clic sur le bouton retour
				if($session->check('Engagement.id_Inscription')) {
		    		$inscription = $inscriptionsTable->get($session->read('Engagement.id_Inscription')); 				
				} else {
					$inscription = $inscriptionsTable->newEntity();					
				}
		    	// Atribution des valeurs
		    	$inscription->name = $name;
		    	//Transformation de la date : dd/mm/yyyy vers yyyy-mm-dd 
		    	if(isset($date_engagement)) {
		    		$tmp_date = $date_engagement;
		    		$date_engagement = substr($tmp_date, 6,4)."-".substr($tmp_date, 3,2)."-".substr($tmp_date, 0,2);
		    	}
		    	
				$inscription->date_engagement = $date_engagement;
				$inscription->numero_demarche = $numero_demarche;
				$inscription->score = $score;
				$inscription->etablissement = $etablissement;
				$inscription->situation_crise = $situation_crise;
				$inscription->restructuration = $restructuration;
				$inscription->reponses = $reponses;
				
				//debug($inscription);die();
				
		    	//Enregistrement
		    	$inscriptionsTable->save($inscription);

		    	
		    	//Enregistrement de l'ID en session en cas de retour
		    	if(! $session->check('Engagement.id_Inscription')) $session->write('Engagement.id_Inscription',$inscription->id);
		    			    	
		    	//Renvoi à la vue
		    	$this->set(compact('score'));
    			$this->render('validate');
	    	} else {
	    		//redirection vers page d'erreur
	    		$this->redirect(['controller' => 'Inscriptions', 'action' => 'validate', '3']);
	    	}
	    	
		} else {
		    //Récupération des information sur l'établissement
		    $this->loadModel('Etablissements');
		    $etablissement = $this->Etablissements->find('all')->where(['id' => $session->read('Engagement.Id_Etablissement')])->first();

		    if ($etablissement->niveau_certification == "Non Certification") {
		    	//Retour pour la page non validee
		    	$this->redirect(['controller' => 'Inscriptions', 'action' => 'validate', '2']);
		    }		    
		    
		    $this->set(compact('etablissement'));
	    	//Récupération des questions
		    $this->loadModel('Questions');
		    $questions = $this->Questions->find('all')->order(['ordre' => 'asc']);
			$this->set(compact('questions'));
	    }
	    
    }
}
