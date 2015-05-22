<?php 

$session = $this->request->session();
if($session->check('Auth.User.role') && $session->read('Progress.Menu') > 0) { ?>
	<p class="boiteOutil">Outils pédagogiques</p>
<?php 
	foreach ($listeOutilsPeda as $outilP):
		echo h($outilP->name)."&nbsp;&nbsp;".$this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/'.h($outilP->name), ['class' => 'titre','target' => '_blank','escape' => false]);
	                   
	endforeach;
?>
	<p class="boiteOutil">Outils clé en main</p>
<?php 
	foreach ($listeOutilsCle as $outilC):
	echo "Clé : ".$outilC->name."<br />";
	endforeach;
} 
?>        
