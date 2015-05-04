<?php
// Dans un controller
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Event\Event;
use Cake\Network\Email\Email;


class ContactController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Securite');
	}
	
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['index','setErrors']);
	}
	
	public function index()
	{
		$contact = new ContactForm();
		if ($this->request->is('post')) {
			
			if ($this->request->is('post')) {
				if ($contact->execute($this->request->data)) {
					
					$message = $this->request->data('body');
					$adresse_mail = $this->request->data('email'); 
					$name = $this->request->data('name'); 
					$captcha_utilisateur = $this->request->data('captcha'); 

					$session = $this->request->session();
					$captchaVerif = $session->read('Captcha');
					
					//debug("user : ".$captcha_utilisateur." verif :".$captchaVerif);die();
					if($captcha_utilisateur === $captchaVerif) {
						//Recuperation de l'email de contact
    					$this->loadModel('Parametres');
    					$emailContact = $this->Parametres->find('all')->where(['name' => 'EmailContact'])->first();
    					$sujetEmailContact = $this->Parametres->find('all')->where(['name' => 'SujetEmailContact'])->first(); 
						
						
						$email = new Email('default');
						$email->template('contact')
						->emailFormat('html')
						->to($emailContact)
						->from($adresse_mail)
						->subject($sujetEmailContact)
		                ->viewVars(['name'=>$name,'email'=>$adresse_mail,'message'=>$message])
						->send();
						
						$this->Flash->success('Votre message a bien été transmis.');
					} else $this->Flash->error('Erreur dans la recopie de l\'anti-robot');
				} else {
					$this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
				}
			}
			
		}

		$session = $this->request->session();
		$captcha = $this->Securite->getCodeCaptcha();
		$session->write('Captcha',$captcha);
        $this->set('captcha', $captcha);
		
        
        //Values from the User Model e.g.
        $this->request->data['name'] = '';
        $this->request->data['email'] = '';
        $this->request->data['body'] = '';
        $this->request->data['captcha'] = '';
        $this->set('contact', $contact);
	}
	
	public function setErrors($errors)
	{
		$this->_errors = $errors;
	}
}
