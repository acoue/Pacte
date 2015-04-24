<?php
// Dans un controller
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Event\Event;
use Cake\Network\Email\Email;


class ContactController extends AppController
{

	
	
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

					$email = new Email('default');
					$email->template('contact')
					->emailFormat('html')
					->to('refex@has-sante.fr')
					->from($adresse_mail)
					->subject('[Pacte] Message utilisateur provenant du site')
	                ->viewVars(['name'=>$name,'email'=>$adresse_mail,'message'=>$message])
					->send();
					
					$this->Flash->success('Votre message a bien été transmis.');
				} else {
					$this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
				}
			}
			
			
			
			
			
		}
        
             //Values from the User Model e.g.
             $this->request->data['name'] = '';
             $this->request->data['email'] = '';
             $this->request->data['body'] = '';
        

        $this->set('contact', $contact);
	}
	
	public function setErrors($errors)
	{
		$this->_errors = $errors;
	}
}
