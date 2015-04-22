<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

/**
 * Inscriptions Controller
 *
 * @property \App\Model\Table\EquipesTable $Equipes
 */
class InscriptionsController extends AppController
{
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['index','add','create', 'validate', 'validate_refus']);
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
	    $session->write('Progress.Menu','1');
	    $session->write('Progress.SousMenu','1');
	    	
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
    	$session->write('Progress.Menu','1');
    	$session->write('Progress.SousMenu','1');
    	
    	//Validation
    	if ($this->request->is(['post', 'put'])) {
    		
   			$email = new Email('gmail');
            $email->template('default')
                ->emailFormat('html')
                ->to('a.coue@has-sante.fr')
                ->from('refex@has-sante.fr')
                ->send();
    		
//     		$boolOK = true;
    		
//     		//Creation du User    			
//     		$length = 8;    		
//     		$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    		
//     		$username = "";
    		
//     		//Stockage en base de donnees
//     		$usersTable = TableRegistry::get('Users');  		 
//     		$user = $usersTable->newEntity();    		
//     		// Atribution des valeurs
//			$user->id = null;
//     		$user->username = $username;    
//     		$user->password = $password;    	
//     		$user->role = "equipe";    			
//     		//Enregistrement
//     		$usersTable->save($user);    		 
//     		//Enregistrement de l'ID en session en cas de retour
//     		$id_User = $user->id;
    		
    		
    		
    		
//     		//Creation Equipe
    	
//     		//Creation de la démarche
    	
//     		//Creation reponses
    	
//     		//Envoi du mail recap
    	
//     		//Redirection
//     		if($boolOk) {
//     			$message = "Inscription validée";
//     			$this->set(compact('message'));
//     			$this->render('validate_accept');
//     		} else {
//     			$message = "une erreur s'est produite";
//     			$this->set(compact('message'));
//     			$this->render('validate_refus');
//     		}
    	
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
	    $session->write('Progress.Menu','1');
	    $session->write('Progress.SousMenu','1');
		

	    if ($this->request->is(['post', 'put'])) {
	    		    	
	    	//debug($this->request->data); die();
	    	$boolInscription = true;
	    	// Calculer le score
	    	$score = 0;
	    	$situation_crise = 0;
	    	$restucturation = 0;
	    	$reponses = "";
	    	$resultat = $this->request->data;	    	
	    	
	    	//Explode des reponses
	    	//Situation de crise
	    	if($resultat['q_9'] == 'N') {
	    		$situation_crise = 1; 
	    		$reponses .= "1-N#";
	    	} else $reponses .= "1-O#";
	    	
	    	// Restructuration
	    	if($resultat['q_10'] == 'N') {
	    		$restucturation = 1; 
	    		$reponses .= "2-N#";
	    	} else $reponses .= "2-O#";
	    	
	    	//Question 1	    	
	    	if($resultat['q_1'] == 'O') {
	    		$score = $score + 1;
	    		$reponses .= "3-O#";
	    	} else $reponses .= "3-N#";
	    	
	    	//Question 2
	    	if($resultat['q_2'] == 'O') {
	    		$score = $score + 1;
	    		$reponses .= "4-O#";
	    	} else $reponses .= "4-N#";
	    	
	    	//Question 3
	    	if($resultat['q_3'] == 'O')  {
	    		$score = $score + 1;
	    		$reponses .= "5-O#";
	    	} else $reponses .= "5-N#";
	    	
	    	//Question 4
	    	if($resultat['q_4'] == 'O') {
	    		$score = $score + 1;
	    		$reponses .= "4-O#";
	    	} else $reponses .= "4-N#";
	    	
	    	//Question 5
	    	if($resultat['q_5'] == 'O')  {
	    		$score = $score + 1;
	    		$reponses .= "5-O#";
	    	} else $reponses .= "5-N#";
	    	
	    	//Question 6
	    	if($resultat['q_6'] == 'O')  {
	    		$score = $score + 1;
	    		$reponses .= "6-O#";
	    	} else $reponses .= "6-N#";
	    	
	    	//Question 7
	    	if($resultat['q_7'] == 'O') {
	    		$score = $score + 1;
	    		$reponses .= "9-O#";
	    	} else $reponses .= "9-N#";
	    	
	    	//Question 8
	    	if($resultat['q_8'] == 'O')  {
	    		$score = $score + 1;
	    		$reponses .= "10-O";
	    	} else $reponses .= "10-N";	    	
	    	
	    	$score = $score + $restucturation + $situation_crise;	    	    	
	    	
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
				$inscription->restucturation = $restucturation;
				$inscription->reponses = $reponses;
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
