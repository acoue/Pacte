<?php 
$session = $this->request->session();

//Outil quand utilisateur connecté
echo "<p>";
if($session->check('Auth.User.role') && $session->read('Progress.Menu') > 0) { 

	if(count($listeOutilsPhase) > 0 ) {	
		echo "<table cellpadding='0' cellspacing='0' class='table table-condensed' width='80%'>";
// 		echo "<thead>";
// 		echo "<tr>";
// 		echo "<th colspan='2' width='50%'><span class='boiteOutil' >Outils pédagogiques</span></th>";
// 		echo "<th colspan='2' width='50%'><span class='boiteOutil' >Outils clé en main</span></th>";
// 		echo "</tr>";
// 		echo "</thead>";
		echo "<tbody>";
		
		foreach ($listeOutilsPhase as $outilP):
			echo "<tr style='background-color:".$outilP['couleur'].";' >";
			echo "	<td width='20%'>".$outilP['thematique']."</td>";
			echo "	<td width='20%'><span><i class='glyphicon glyphicon-file'></i></span>   ";
			echo $this->Html->link($outilP['libelle'], '/files/outil/'.$outilP['name'], ['class' => 'titre','target' => '_blank','escape' => false])."</td>";				
			echo "	<td width='50%'>".$outilP['texte']."</td>";
			
			if($outilP['type']== "pedagogiques") echo "	<td width='10%' align='center'>".$this->Html->image('peda.png',['height' => '16px','title' => 'Outil pédagogique'])."</td>";
			else if ($outilP['type']== "cle") echo "	<td width='10%' align='center'>".$this->Html->image('cle.png',['height' => '16px','title' => 'Outil clé en main'])."</td>";
			else echo "	<td width='10%'></td>";		
			
			echo "</tr>";
		endforeach;

		echo "</tbody>";
		echo "</table>";
	} 
	
} else { 
	//Outil quand utilisateur non connecté	
 	if(count($listeOutilsDivers) >0) {

 		echo"<table cellpadding='0' cellspacing='0' class='table table-condensed' width='80%'>";
// 		echo "<thead><tr><th width='40%'>Fichier</th><th width='60%'>Description</th></tr>";
 		echo "<tbody>";
		
 		foreach ($listeOutilsDivers as $outilD):
 		echo "<tr style='background-color:".$outilD['couleur'].";' >";
		echo "	<td width='20%'>".$outilD['thematique']."</td>";
			echo "	<td width='20%'><span><i class='glyphicon glyphicon-file'></i></span>   ";
			echo $this->Html->link($outilD['libelle'], '/files/outil/'.$outilD['name'], ['class' => 'titre','target' => '_blank','escape' => false])."</td>";				
			echo "	<td width='50%'>".$outilD['texte']."</td>";
			
			if($outilD['type']== "pedagogiques") echo "	<td width='10%' align='center'>".$this->Html->image('peda.png',['height' => '16px','title' => 'Outil pédagogique'])."</td>";
			else if ($outilD['type']== "cle") echo "	<td width='10%' align='center'>".$this->Html->image('cle.png',['height' => '16px','title' => 'Outil clé en main'])."</td>";
			else echo "	<td width='10%'></td>";		
			
			echo "</tr>";
 		endforeach;

 		echo "</tbody></table>";
	}	
}
echo "</p>";
?>        
