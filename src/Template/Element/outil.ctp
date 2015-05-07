<?php 
$session = $this->request->session();
if ($session->check('Progress.Menu')) {
    $menu = $session->read('Progress.Menu');
} else $menu=1;

if ($session->check('Progress.SousMenu')) {
    $sous_menu = $session->read('Progress.SousMenu');
} else $sous_menu=1;
  
if($session->check('Auth.User.role')) { ?>
	<p class="boiteOutil">Outils pédagogiques</p>
<?php 
	foreach ($listeOutilsPeda as $outilP):
	 echo "<a href='/files/outil/".$outilP->name."' target='_blank'>".$outilP->name."   <span><i class='glyphicon glyphicon-open'></i></span></a>";
	endforeach;
?>
	<p class="boiteOutil">Outils clé en main</p>
<?php 
	foreach ($listeOutilsCle as $outilC):
	echo "Clé : ".$outilC->name."<br />";
	endforeach;
} 
?>        
