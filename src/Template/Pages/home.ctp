<?php
$session = $this->request->session();

if($session->check('Auth.User.role')) {
	$role = $session->read('Auth.User.role');
	
	if($role === 'admin') {
		echo "Bienvenue Administrateur";
	} else if($role === 'has') {
		echo "Bienvenue Chef de Projet HAS";
	} else if($role === 'expert') {
		echo "Bienvenue Expert Visiteur";
	} else if($role === 'equipe') {
		if($session->read('Equipe.Engagement') == 0 ){
			echo $this->Html->link('Poursuivre l\'engagement', ['controller'=>'membres', 'action' => 'index/0/1'],['class' => 'btn btn-info']);
			
		} else echo "Bienvenue Equipe";
		
		
		
		
		
		
	}
}

