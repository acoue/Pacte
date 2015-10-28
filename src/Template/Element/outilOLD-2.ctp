<?php 
$session = $this->request->session();

//Outil quand utilisateur connecté
if($session->check('Auth.User.role') && $session->read('Progress.Menu') > 0) { 
	
	(!empty($listeOutilsPeda)) ? $nbOutilPeda = count($listeOutilsPeda) : $nbOutilPeda = -1;
	(!empty($listeOutilsCle)) ? $nbOutilCle = count($listeOutilsCle) : $nbOutilCle = -1;
	$nbTour = 0;
	
	//Calcul du nombre de tour à effectuer
	($nbOutilPeda >= $nbOutilCle) ? $nbTour = $nbOutilPeda :  $nbTour = $nbOutilCle ;
	
	echo "<p>";


	if($nbTour > 0 ) {	
		echo "<table cellpadding='0' cellspacing='0' class='table table-condensed' width='80%'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th colspan='2' width='50%'><span class='boiteOutil' >Outils pédagogiques</span></th>";
		echo "<th colspan='2' width='50%'><span class='boiteOutil' >Outils clé en main</span></th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		
		for($i=0;$i<$nbTour;$i++) {
			echo "<tr>";
			//Affichage des outils pédagogiques
			if($i <= $nbOutilPeda) {
				echo "<td width='20%'><span><i class='glyphicon glyphicon-file'></i></span>  ";
				echo $this->Html->link($listeOutilsPeda[$i]['libelle'], '/files/outil/'.$listeOutilsPeda[$i]['name'], ['class' => 'titre','target' => '_blank','escape' => false])."</td>";
				echo "<td width='30%'>".$listeOutilsPeda[$i]['texte']."</td>";
			} else {
				echo "<td width='20%'></td><td width='30%'></td>";
			}
			
			if($i <= $nbOutilCle) {
				echo "<td width='20%'><span><i class='glyphicon glyphicon-file'></i></span>  ";
				echo $this->Html->link($listeOutilsCle[$i]['libelle'], '/files/outil/'.$listeOutilsCle[$i]['name'], ['class' => 'titre','target' => '_blank','escape' => false])."</td>";
				echo "<td width='30%'>".$listeOutilsCle[$i]['texte']."</td>";
			} else {
				echo "<td width='20%'></td><td width='30%'></td>";
			}
			echo "</tr>";
		}

		echo "</tbody>";
		echo "</table>";
	} 
	
	if(count($listeOutilsToutes) > 0){	
		echo "<table cellpadding='0' cellspacing='0' class='table table-condensed' width='80%'>";
 		echo "<thead>";
 		echo "<tr>";
 		echo "<th colspan='2'><span class='boiteOutil'>Outils permanents</span></th>";
 		echo "</tr>";
// 		echo "</thead>";
		echo "<tbody>";
		foreach ($listeOutilsToutes as $outilT):
			echo "<tr>";
			echo "<td width='40%'><span><i class='glyphicon glyphicon-file'></i></span>  ";
			echo $this->Html->link($outilT['libelle'], '/files/outil/'.$outilT['name'], ['class' => 'titre','target' => '_blank','escape' => false])."</td>";
			echo "<td width='60%'>".$outilT['texte']."</td>";
			
			echo "</tr>";
		endforeach;
		echo "</tbody>";
		echo "</table>";
	}
	echo "</p>";
} else { 
	//Outil quand utilisateur non connecté	
	if(count($listeOutilsDivers) >0) {
		
		echo "<p><table cellpadding='0' cellspacing='0' class='table table-condensed' width='80%'>";
		echo "<thead><tr><th width='40%'>Fichier</th><th width='60%'>Description</th></tr>";
		echo "<tbody>";
		
		foreach ($listeOutilsDivers as $outilD):
		echo "<tr><td><span><i class='glyphicon glyphicon-file'></i></span>  ";
		echo $this->Html->link($outilD['libelle'], '/files/outil/'.$outilD['name'], ['class' => 'titre','target' => '_blank','escape' => false])."</td>";
		echo "<td>".$outilD['texte']."</td></tr>";
		endforeach;

		echo "</tbody></table></p>";
	}	
}
?>        
