<?php 
$session = $this->request->session();
if ($session->check('Progress.Menu')) {
    $menu = $session->read('Progress.Menu');
} else $menu = 0;

if ($session->check('Progress.SousMenu')) {
    $sous_menu = $session->read('Progress.SousMenu');
} else $sous_menu = 0;
  
//fin des 2 premieres phases
if($session->read('MiseEnOeuvre')) {
	$menu = 3;
	$sous_menu = 0;
}

//Dernieres phases
if($session->read('Equipe.Evaluation')) {
	$menu = 4;
	$sous_menu = 0;
}

if($menu > 0 ){

//libellé
$libMenu1 = "Phase d'engagement";
$libMenu2 = "Phase de diagnostic";
$libMenu3 = "Phase de mise en oeuvre et de suivi";
$libMenu4 = "Phase d'évaluation";
$libSousMenu1 = "Projet d'équipe";
$libSousMenu2 = "Fonctionnement d'équipe";
$libSousMenu3 = "Objectifs d'amélioration";
$libSousMenu4 = "Evaluation à T0";	
	
	
	
?>
<div class="container">
    <div>
      <table class='tableProgress'>
        <tbody>

<?php 
switch ($menu) {
    case 1: 
        echo "<tr>";
        echo "<td width='25%' class='celluleGaucheEnCours'>".$libMenu1."</td>";
        echo "<td width='25%' class='celluleNonOk'>".$libMenu2."</td>";
        echo "<td width='25%' class='celluleNonOk'>".$libMenu3."</td>";
        echo "<td width='25%' class='celluleDroiteNonOk'>".$libMenu4."</td>";
        echo "</tr>";
        break;
    case 2:
        echo "<tr>";
        echo "<td width='25%' class='celluleGaucheOk'>".$libMenu1."</td>";
        echo "<td width='25%' class='celluleEnCours'>".$libMenu2."</td>";
        echo "<td width='25%' class='celluleNonOk'>".$libMenu3."</td>";
        echo "<td width='25%' class='celluleDroiteNonOk'>".$libMenu4."</td>";
        echo "</tr><tr>";  
        echo "<td colspan='3'><div class='arrow_box'></div></td>";
        echo "<td></td>";
        echo "</tr>";
        
        switch ($sous_menu) {
        	case 1:
		        echo "<tr>";
		        echo "<td width='25%' class='sousCelluleGaucheEnCours'>".$libSousMenu1."</td>";
		        echo "<td width='25%' class='sousCelluleNonOk'>Fonctionnement d'équipe</td>";
		        echo "<td width='25%' class='sousCelluleNonOk'>Objectifs d'amélioration</td>";
		        echo "<td width='25%' class='sousCelluleDroiteNonOk'>Evaluation à T0</td>";
		        echo "</tr>";  
		        break;
	        case 2:
	        	echo "<tr>";
	        	echo "<td width='25%' class='sousCelluleGaucheOk'>".$libSousMenu1."</td>";
	        	echo "<td width='25%' class='sousCelluleEnCours'>".$libSousMenu2."</td>";
	        	echo "<td width='25%' class='sousCelluleNonOk'>".$libSousMenu3."</td>";
	        	echo "<td width='25%' class='sousCelluleDroiteNonOk'>".$libSousMenu4."</td>";
	        	echo "</tr>";
	        	break;
	        case 3:
	        	echo "<tr>";
	        	echo "<td width='25%' class='sousCelluleGaucheOk'>".$libSousMenu1."</td>";
	        	echo "<td width='25%' class='sousCelluleOk'>".$libSousMenu2."</td>";
	        	echo "<td width='25%' class='sousCelluleEnCours'>".$libSousMenu3."</td>";
	        	echo "<td width='25%' class='sousCelluleDroiteNonOk'>".$libSousMenu4."</td>";
	        	echo "</tr>";
	        	break;
	        case 4:
	        	echo "<tr>";
	        	echo "<td width='25%' class='sousCelluleGaucheOk'>".$libSousMenu1."</td>";
	        	echo "<td width='25%' class='sousCelluleOk'>".$libSousMenu2."</td>";
	        	echo "<td width='25%' class='sousCelluleOk'>".$libSousMenu3."n</td>";
	        	echo "<td width='25%' class='sousCelluleDroiteEnCours'>".$libSousMenu4."</td>";
	        	echo "</tr>";
	        	break;
        }
        break;
    case 3:
        echo "<tr>";
        echo "<td width='25%' class='celluleGaucheOk'>".$libMenu1."</td>";
        echo "<td width='25%' class='celluleOk'>".$libMenu2."</td>";
        echo "<td width='25%' class='celluleEnCours'>".$libMenu3."</td>";
        echo "<td width='25%' class='celluleDroiteNonOk'>".$libMenu4."</td>";
        echo "</tr>";
        break;
    case 4:
        echo "<tr>";
        echo "<td width='25%' class='celluleGaucheOk'>".$libMenu1."</td>";
        echo "<td width='25%' class='celluleOk'>".$libMenu2."</td>";
        echo "<td width='25%' class='celluleOk'>".$libMenu3."</td>";
        echo "<td width='25%' class='celluleDroiteEnCours'>".$libMenu4."</td>";
        echo "</tr>";
        break;
} 

?>        
        </tbody>
      </table>    
    </div>
</div><br />
<?php } ?>