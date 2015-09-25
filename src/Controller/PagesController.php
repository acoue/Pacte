<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\I18n\Time;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

// 	public function beforeFilter(Event $event)
// 	{	
// 		$this->Auth->allow(['display']);
// 	}
    public function isAuthorized($user)
    {
    	// Admin peuvent acceder a chaque action
    	if (isset($user['role'])) {
    		return true;
    	}
    
    	parent::isAuthorized($user);
    }
	
	
    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {

    	
        $path = func_get_args();

       /* $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));*/

        try {

        	$session = $this->request->session();
        	//Message
        	$this->loadModel('Parametres');    	        	
        	$id_demarche = $session->read('Equipe.Demarche');
        	
        	//Recuperation 
        	if($session->read('Auth.User.role') === 'admin'){
        		$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilAdministrateur'])->first();
        		//récuperation des équipes : 1 démarches actives par démarche
        		$this->loadModel('Equipes');
        		$equipes = $this->Equipes->find('All',['contain'=>'Etablissements']);  
        		$this->set(compact('equipes','message'));      	
        	} else {
        		$idUser = $session->read('Auth.User.id');
        		$this->loadModel('EquipesUsers');
        		$equipeUsers = $this->EquipesUsers
        		->find('all')
        		->contain(['Equipes' => ['Etablissements']])
        		->where(['EquipesUsers.user_id ='=>$idUser]);
        		
        		
        		if($session->read('Auth.User.role') == 'expert') {
        			$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilExpert'])->first();
        		} else if($session->read('Auth.User.role') == 'has') {
        			$message = $this->Parametres->find('all')->where(['name' => 'MessageAccueilCpHas'])->first();
        		} else {	
        			if($session->read('Equipe.Engagement') == 0 ) {
        				$messageData = $this->Parametres->find('all')->where(['name' => 'MessageAccueilEquipeEngagement'])->first();
        				$message=$messageData->valeur;
        			} else if($session->read('Equipe.Diagnostic') == 0 ) {
        				$messageData = $this->Parametres->find('all')->where(['name' => 'MessageAccueilEquipeDiagnostic'])->first();
        				$message=$messageData->valeur;
        				$message=$messageData->valeur;
        				
        				//TEST        				
//         				$this->loadModel('Parametres');
//         				$sujetReq = $this->Parametres->find()->where(['name' => 'SujetEmailRecapitulatifEngagement'])->first();
//         				$sujetSource = $sujetReq->valeur;
        				
//         				$sujet = trim($sujetSource);
//         				$sujet1 = strip_tags($sujetSource);
//         				$this->set('sujet',$sujet);
//         				$this->set('sujet1',$sujet1);
        				//FIN DE TEST
        				
        			} else if($session->read('Equipe.MiseEnOeuvre') == 0 ) {
	        			$messageData = $this->Parametres->find('all')->where(['name' => 'MessageAccueilEquipeMiseEnOeuvre'])->first();
        				$message=$messageData->valeur;
        				
        				//Date d'entree dans la phase
        				$this->loadModel('DemarchePhases');
        				$datePhase = $this->DemarchePhases->find('all')
        				->where(['demarche_id' => $id_demarche,'phase_id'=>'3'])->first();
        				$this->set('datePhase',$datePhase->date_entree);
        				
	        		} else if($session->read('Equipe.Evaluation') == 0 ) { 
	        			$messageData = $this->Parametres->find('all')->where(['name' => 'MessageAccueilEquipeEvaluation'])->first();
        				$message=$messageData->valeur;
        				//Date d'entree dans la phase
        				$this->loadModel('DemarchePhases');
        				$datePhase = $this->DemarchePhases->find('all')
        				->where(['demarche_id' => $id_demarche,'phase_id'=>'4'])->first();
        				$this->set('datePhase',$datePhase->date_entree);
        				
	        		} else {
	        			//Demarche terminée
	        			$message = "Bienvenue";

	        			//Récupération de l'état de l'engagement de l'équipe
	        			$this->loadModel('DemarchePhases');
	        			$etat = $this->DemarchePhases->find('all')
	        			->where(['demarche_id' => $session->read('Equipe.Demarche'),'phase_id'=>'4'])->first();

	        			$date1 = new Time($etat->date_validation);
						$date2 = new Time(); 
						$interval = $date2->diff($date1)->format("%a");    
						
						$this->set('dateMax',$date1->addDays(182));
	        			$this->set('interval',$interval);
	        			$this->set('equipe',$session->read('Equipe.Identifiant'));
	        			
	        		}
        		}        		
        		
        		$this->set(compact('equipeUsers','message'));
        	}
      	
        	//Graphique
        	$titre = "titre";
        	$sousTitre = "Sous titre";
        	$labelYDroit = "Label axe Y à droite";
        	$labelYGauche = "Label axe Y à gauche";
        	$labelX = "Label Axe X";
        	$legende1 = "Légende bleue";
        	$legende2 = "Légende rouge";
        	$legende3 = "Légende 3";
        	
        	
        	$tab_globales = [
        			[$labelX, $legende1, $legende2,	$legende3],
        			['Canis Major Dwarf', 8000, 23.3,10],
        			['Sagittarius Dwarf', 24000, 4.5,20],
        			['Ursa Major II Dwarf', 30000, 14.3,30],
        			['Lg. Magellanic Cloud', 50000, 0.9,25],
        			['Bootes I', 60000, 13.1,20]
        	];
        	$this->set(compact('titre','sousTitre','labelYDroit','labelYGauche','tab_globales'));
        	
        	
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
    
    public function permission()
    {
    	
    }
    
}
