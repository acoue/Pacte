<?php 
$session = $this->request->session();

//Outil quand utilisateur connecté
if($session->check('Auth.User.role') && $session->read('Progress.Menu') > 0) { 
	if(!empty($listeOutilsPeda)) {
		echo "<p class='boiteOutil'>Outils pédagogiques</p>";
		foreach ($listeOutilsPeda as $outilP):
			echo $this->Html->link(h($outilP->name), '/files/outil/'.h($outilP->name), ['class' => 'titre','target' => '_blank','escape' => false]);
		                   
		endforeach;
	}
	
	if(isset($listeOutilsCle)) {
		echo "<p class='boiteOutil'>Outils clé en main</p>";
		foreach ($listeOutilsCle as $outilC):
			echo $this->Html->link(h($outilC->name), '/files/outil/'.h($outilC->name), ['class' => 'titre','target' => '_blank','escape' => false]);
		endforeach;
	}
	
} else { 
	//Outil quand utilisateur non connecté	
	//if($session->check('Progress.Menu')) {
		
		//Inscription
		//echo "<p class='boiteOutil'>Outils</p>";
		echo "Volet d’engagement &nbsp;&nbsp;".$this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/2015 01 25_ENGAGEMENT_DIRECTION_V1.docx', ['class' => 'titre','target' => '_blank','escape' => false]);
	//}
	
}
?>        
