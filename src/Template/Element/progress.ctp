<?php 
$session = $this->request->session();
if ($session->check('Progress.Menu')) {
    $menu = $session->read('Progress.Menu');
} else $menu=1;

if ($session->check('Progress.SousMenu')) {
    $sous_menu = $session->read('Progress.SousMenu');
} else $sous_menu=1;
  
?>
<div class="container">
    <div>
      <table class='tableProgress'>
        <tbody>

<?php 
if($session->check('User.Role')) {
	switch ($menu) {
	    case 1: 
	        echo "<tr>";
	        echo "<td width='25%' class='celluleGaucheEnCours'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleNonOk'>Phase de diagnostic</td>";
	        echo "<td width='25%' class='celluleNonOk'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleDroiteNonOk'>Phase d'évaluation</td>";
	        echo "</tr>";
	        break;
	    case 2:
	        echo "<tr>";
	        echo "<td width='25%' class='celluleGaucheOk'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleEnCours'>Phase de diagnostic</td>";
	        echo "<td width='25%' class='celluleGaucheNonOk'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleDroiteNonOk'>Phase d'évaluation</td>";
	        echo "</tr><tr>";
	    
	    //A MODIFIER
	    
	        echo "<td colspan='3'><div class='arrow_box'></div></td>";
	        echo "<td></td>";
	        echo "</tr>";
	        echo "<tr>";
	        echo "<td width='25%' class='sousCelluleGaucheOk'>Projet d\'équipe</td>";
	        echo "<td width='25%' class='sousCelluleOk'>Phase de diagnostic</td>";
	        echo "<td width='25%' class='sousCelluleEnCours'>Plan d\'action</td>";
	        echo "<td width='25%' class='sousCelluleDroiteNonOk'>Mesures</td>";
	        echo "</tr>";  
	    //FIN A MODIFIER
	    
	    
	    
	    
	    
	        break;
	    case 3:
	        echo "<tr>";
	        echo "<td width='25%' class='celluleGaucheOk'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleOk'>Phase de diagnostic</td>";
	        echo "<td width='25%' class='celluleEnCours'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleDroiteNonOk'>Phase d'évaluation</td>";
	        echo "</tr>";
	        break;
	    case 2:
	        echo "<tr>";
	        echo "<td width='25%' class='celluleGaucheOk'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleOk'>Phase de diagnostic</td>";
	        echo "<td width='25%' class='celluleOk'>Phase d'engagement</td>";
	        echo "<td width='25%' class='celluleDroiteEnCours'>Phase d'évaluation</td>";
	        echo "</tr>";
	        break;
	} 
}
?>        
        </tbody>
      </table>    
    </div>
</div>