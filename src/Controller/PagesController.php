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
	public $helpers = [
        'ChartJs.Chartjs' => [
            'Chart' => [
                'type' => 'bar',
            ],
            'Canvas' => [
                'position' => 'relative',
                'width' => 750,
                'height' => 300,
                'css' => ['padding' => '10px'],
            ],
            'Options' => [
                'responsive' => true,
                'Bar' => [
                    'scaleShowGridLines' => false 
                ]
            ],
        ]
    ];
	
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
        	
        	
        	
        	//$this->loadModel('Graphiques');
        	//$rounds = $this->Graphiques->find('all', ['fields' => ['name','valeur']]);
        	
        	//debug($rounds);die();
        	//Setup data for chart
        	
// 			$dataChart = [
// 			    'labels' => ["January", "February", "March", "April", "May", "June", "July"],
// 			    'datasets' => [
// 			            [ 
// 			                'label' => "My First dataset",
// 			                'data' => [65, 59, 80, 81, 56, 55, 40]
// 			            ],
// 			            [
// 			                'label' => "My Second dataset",
// 			                'data' => [28, 48, 40, 19, 86, 27, 90]
// 			            ]
// 			    ]
// 			];
//         	//Set the chart for your view
//         	$this->set(compact('dataChart'));

//         	foreach ($rounds as $r):
        	
        	
//         	endforeach;
        	       	
        	
        	
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
