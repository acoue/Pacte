<?php
// Dans un controller
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Event\Event;

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
			if ($contact->execute($this->request->data)) {
				$this->Flash->success('Votre message a bien été transmis.');
			} else {
				$this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
			}
		}
//         if ($this->request->is('get')) {
//             //Values from the User Model e.g.
//             $this->request->data['name'] = 'John Doe';
//             $this->request->data['email'] = 'john.doe@example.com';
//         }

        $this->set('contact', $contact);
	}
	
	public function setErrors($errors)
	{
		$this->_errors = $errors;
	}
}
