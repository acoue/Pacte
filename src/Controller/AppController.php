<?php
/**
 * Ce fichier fait partie du projet Pacte.
 *
 * Cette classe est le controlelur principale de l'application, passage obligé
 *
 * @package Controlleur
 * @copyright 2015 Haute Autorité de Santé (HAS)
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * La classe AppController est le controlleur principal de l'application
 *
 * @author Anthony COUE <a.coue[@]has-sante.fr>
 */

class AppController extends Controller
{
	
	public $components = array('RequestHandler');
	public $helpers = ['AkkaCKEditor.CKEditor'];
	
    /**
     * Méthode d'initialisation du controlleur
     *
     * Permet d'appeler les helper et de charger les composants utiles à l'application
     * Renseigne l'objet Session et récupère les outils à afficher
     * 
     * @return void
     */
	public function initialize()
    {
    	parent::initialize();
    	$this->loadComponent('Flash');
    	$this->loadComponent('Auth', [
    			'loginRedirect' => [
    					'controller' => 'Pages',
    					'action' => 'display',
    					'home'
    			],
    			'logoutRedirect' => [
    					'controller' => 'Users',
    					'action' => 'login'
    			],
    			'authenticate' => [
    					'Form' => [
    							'scope' => ['Users.active' => 1]
    					]
    			]
    	]);
    	
		//Chargement de l'objet session
    	$session = $this->request->session();
    	//Mise en session de la valeur des menus en fonction de la phase de l'utilisateur connecté
    	if($session->check('Equipe.Engagement') && $session->read('Equipe.Engagement') == 0 ) {
    		$session->write('Progress.Menu','1');
    		$session->write('Progress.SousMenu','0');
    	} else if($session->check('Equipe.Diagnostic') && $session->read('Equipe.Diagnostic') == 0 ) {
    		$session->write('Progress.Menu','2');
    		$session->write('Progress.SousMenu','1');
    	} else if($session->check('Equipe.MiseEnOeuvre') && $session->read('Equipe.MiseEnOeuvre') == 0 ) {
    		$session->write('Progress.Menu','3');
    		$session->write('Progress.SousMenu','0');
    	} else if($session->check('Equipe.Evaluation') && $session->read('Equipe.Evaluation') == 0 ) {
    		$session->write('Progress.Menu','4');
    		$session->write('Progress.SousMenu','0');
    	} else {
    		$session->write('Progress.Menu','0');
    		$session->write('Progress.SousMenu','0');
    	}
    	
    	//information de la version de l'application => affichage en footer
    	$version = "";
    	$dateVersion="";
    	//Message
    	$this->loadModel('Parametres');
    	$message = $this->Parametres->find('all')->where(['name' => 'Version'])->first();
    	$version = trim(rtrim(strip_tags($message->valeur)));
    	$message1 = $this->Parametres->find('all')->where(['name' => 'DateVersion'])->first();
    	$dateVersion = trim(rtrim(strip_tags($message1->valeur)));    	
    	$this->set(compact('version', 'dateVersion'));
    	
    	$phase = $session->read('Progress.Menu');
		$this->loadModel('Outils');
		
		//Récupération des outils suivant la phase
		$outilsPhase = $this->Outils->find('all')->where(['phase_id'=>$phase])->order('thematique,ordre')->toArray();
     	$outilsDivers = $this->Outils->find('all')->where(['phase_id'=>'99'])->order('thematique,ordre')->toArray(); //Outils accueil
     	$outilsToutes = $this->Outils->find('all')->where(['phase_id'=>'98'])->order('thematique,ordre')->toArray(); //Outils toutes phases 
     	$outils = array_merge($outilsPhase,$outilsToutes);
     	    	
    	//Envoi des objet retuor à la page
    	$this->set(['listeOutilsPhase' => $outils,'listeOutilsDivers' => $outilsDivers]);
    	
    }
    
    /* (non-PHPdoc)
     * @see \Cake\Controller\Controller::beforeFilter()
     */
    public function beforeFilter(Event $event)
    {
    	$this->Auth->deny();
    	$this->Auth->config('authorize', ['Controller']);
    	//$this->Auth->config('authorize', ['Actions','Controller']);
    	
    	
    	$this->Auth->config('authError', 'Vous ne disposez pas des droits nécessaires.');
    	$this->Auth->config('unauthorizedRedirect', $this->referer(['controller' => 'pages','action' => 'permission']));
    }

    /**
     * @param unknown $user
     * @return boolean
     */
    public function isAuthorized($user)
    {
    	$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {
    		//Demarche terminée
    		if($session->read('Equipe.DemarcheEtat') == 1) return false;
		}	
		
    	// Admin peuvent acceder a chaque action
    	if (isset($user['role']) && $user['role'] === 'admin') {
    		return true;
    	}

        // Par defaut refuser
    	return false;
    }
}
