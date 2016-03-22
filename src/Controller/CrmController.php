<?php
// Dans un controller
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


class CrmController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Securite');
	}
	
	public function beforeFilter(Event $event)
	{
		//Actions publiques
		$this->Auth->allow(['setErrors']);
	}	
	
	public function isAuthorized($user)
	{
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'animateur') {						
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index'])){
				return true;
			} else {
				return false;
			}
		} 
		
		return parent::isAuthorized($user);
	}
	
	

	public function index()
	{
		
	}
	
	public function setErrors($errors)
	{
		$this->_errors = $errors;
	}
}
