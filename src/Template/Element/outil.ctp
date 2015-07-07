<?php 

$session = $this->request->session();
if($session->check('Auth.User.role') && $session->read('Progress.Menu') > 0) { ?>
	<p class="boiteOutil">Outils pédagogiques</p>
<?php 
	if(isset($listeOutilsPeda)) {
		foreach ($listeOutilsPeda as $outilP):
			echo h($outilP->name)."&nbsp;&nbsp;".$this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/'.h($outilP->name), ['class' => 'titre','target' => '_blank','escape' => false]);
		                   
		endforeach;
	}
?>
	<p class="boiteOutil">Outils clé en main</p>
<?php 
	
	if(isset($listeOutilsCle)) {
		foreach ($listeOutilsCle as $outilC):
			echo h($outilC->name)."&nbsp;&nbsp;".$this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/'.h($outilC->name), ['class' => 'titre','target' => '_blank','escape' => false]);
		endforeach;
	}
	
	//Bouton génération PDF
	echo "<br /><br />";
	echo $this->Html->link('Voir l\'état de sa démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$session->read('Equipe.Identifiant')],['class' => 'btn btn-default']);
	
		
} else { 
	if($session->check('Progress.Menu')) {
		//Inscription
		echo "<p class='boiteOutil'>Outils</p>";
		echo "Volet d’engagement &nbsp;&nbsp;".$this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/2015 01 25_ENGAGEMENT_DIRECTION_V1.docx', ['class' => 'titre','target' => '_blank','escape' => false]);
	}
	
	
}
?>        
