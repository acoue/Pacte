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

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	
	public $components = array('RequestHandler');
	public $helpers = ['AkkaCKEditor.CKEditor'];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
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
    	

    	$session = $this->request->session();

    	
    	
    	
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
    	
    	
	
    	
    	$phase = $session->read('Progress.Menu');
		$this->loadModel('Outils');
    	$outilsPeda = $this->Outils->find('all')->where(['phase_id'=>$phase, 'type'=>'pedagogiques']);
    	$outilsCle = $this->Outils->find('all')->where(['phase_id'=>$phase, 'type'=>'cle']);   	
    	$this->set(['listeOutilsPeda' => $outilsPeda,'listeOutilsCle' => $outilsCle]);
    	
    }
    
    public function beforeFilter(Event $event)
    {
    	$this->Auth->deny();
    	$this->Auth->config('authorize', ['Controller']);
    	//$this->Auth->config('authorize', ['Actions','Controller']);
    	
    	
    	$this->Auth->config('authError', 'Vous ne disposez pas des droits nécessaires.');
    	$this->Auth->config('unauthorizedRedirect', $this->referer(['controller' => 'pages','action' => 'permission']));
    }

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
