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
        	if($session->read('Auth.User.role') === 'admin'){
        		$this->loadModel('Equipes');
        		$equipes = $this->Equipes->find('All',['contain'=>'Etablissements']);  
        		$this->set(compact('equipes'));      	
        	} else {
        		$idUser = $session->read('Auth.User.id');
        		$this->loadModel('EquipesUsers');
        		$equipeUsers = $this->EquipesUsers
        		->find('all')
        		->contain(['Equipes' => ['Etablissements']])
        		->where(['EquipesUsers.user_id ='=>$idUser]);
        		
        		
        		$this->set(compact('equipeUsers'));
        	}
/*
 * 
'La sécurité de la prise en charge du patient en équipe a progressé'
'Le fonctionnement de l'équipe est amélioré'
'Le partenariat avec le patient et/ou de son entourage a progressé'
'Ma contribution au sein de l'équipe est renforcée'
'Ma pratique professionnelle, mon travail sont facilités'
'Mon travail est reconnu'
'Ma fonction est valorisée'
'Pacte répond à mes attentes '
'Vous recommanderiez ce projet à d’autres équipes'
'Niveau de satisfaction global concernant le projet PACTE'

 */        	
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
