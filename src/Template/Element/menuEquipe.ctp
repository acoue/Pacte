<?php 
//Lien sous sous menu http://www.trucsweb.com/tutoriels/css/bootstrap-navbar-multiples-niveaux/

$session = $this->request->session();
$idUser = $session->read('Auth.User.id');

if($session->check('Equipe.Engagement')) $etat_engagement = $session->read('Equipe.Engagement');
if($session->check('Equipe.Diagnostic')) $etat_diagnostic = $session->read('Equipe.Diagnostic');
else $etat_diagnostic = 0;
if($session->check('Equipe.MiseEnOeuvre')) $etat_oeuvre = $session->read('Equipe.MiseEnOeuvre');
else $etat_oeuvre = 0;
if($session->check('Equipe.Evaluation')) $etat_evaluation = $session->read('Equipe.Evaluation');
else $etat_evaluation = 0;

echo "<div id='navbar' class='navbar-collapse collapse'>";
echo "    <ul class='nav navbar-nav'>";
echo "        <li>".$this->Html->link('Accueil','/pages/home')."</li>";
if($etat_engagement == 1 ) {	
		echo "        <li class='dropdown'>";
		echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Engagement <span class='caret'></span></a>";
		echo "            <ul class='dropdown-menu' role='menu'>";
		echo "                <li>".$this->Html->link('Projet','/projets/index')."</li>";
		echo " 				  <li>".$this->Html->link('Membres Référent','/membres/index/0/1')."</li>";
		echo " 				  <li>".$this->Html->link('Membres','/membres/index/0/0')."</li>";
		echo "   			  <li>".$this->Html->link('Comité de pilotage','/membres/index/1/0')."</li>";
		echo "   			  <li>".$this->Html->link('Macro-planning','/projets/calendrier')."</li>";
		echo "            </ul>";
		echo "		  </li>";
}

if($etat_engagement == 1 && $etat_diagnostic == 0 ) {
		echo "        <li>".$this->Html->link('Diagnostic','/projets/diagnostic_index')."</li>";
}

if($etat_engagement == 1 && $etat_diagnostic == 1 && $etat_oeuvre == 0) {	
		echo "        <li class='dropdown'>";
		echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Diagnostic <span class='caret'></span></a>";
		echo "            <ul class='dropdown-menu' role='menu'>";
		echo "                <li>".$this->Html->link('Projet','/projets/diagnostic_index')."</li>";
		echo " 				  <li>".$this->Html->link('Fonctionnement d\'équipe','/Evaluations/index')."</li>";
		echo "            </ul>";
		echo "        </li>";
		echo "        <li class='dropdown'>";
		echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Mise en Oeuvre <span class='caret'></span></a>";
		echo "			  <ul class='dropdown-menu' role='menu'>";
		echo " 			  	<li>".$this->Html->link('Objectifs d\'amélioration','/PlanActions/index')."</li>";
		echo "				<li>".$this->Html->link('Evaluation à T1','/Mesures/index')."</li>";
		echo "              <li>".$this->Html->link('Enquête de satisfaction','/Enquetes/index')."</li>";
// 		echo "          	  <li class='dropdown-submenu'>";
// 		echo "            		  <a tabindex='-1' href='#'>Mesures</a>";
// 		echo "           		  <ul class='dropdown-menu'>";
// 		echo "						  <li>".$this->Html->link('Evaluation à T1','/Mesures/index')."</li>";
// 		echo "             			  <li>".$this->Html->link('Enquête de satisfaction','/Enquetes/index')."</li>";
// 		echo "           		  </ul>";
// 		echo "          	  </li>";
		echo "            </ul>";
		echo "        </li>";
}

if($etat_engagement == 1 && $etat_diagnostic == 1 && $etat_oeuvre == 1 && $etat_evaluation == 0 ) {
	echo "        <li class='dropdown'>";
	echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Diagnostic <span class='caret'></span></a>";
	echo "            <ul class='dropdown-menu' role='menu'>";
	echo "                <li>".$this->Html->link('Projet','/projets/diagnostic_index')."</li>";
	echo "            </ul>";
	echo "        </li>";
	echo "        <li class='dropdown'>";
	echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Evaluation <span class='caret'></span></a>";
	echo "            <ul class='dropdown-menu' role='menu'>";
	echo " 				  <li>".$this->Html->link('Objectifs d\'amélioration','/PlanActions/index')."</li>";
	//echo " 				  <li>".$this->Html->link('Fonctionnement d\'équipe','/Evaluations/index')."</li>";	
	echo "   			  <li>".$this->Html->link('Evaluation à T2	','/Mesures/index')."</li>";		
	echo "                <li>".$this->Html->link('Enquête de satisfaction','/Enquetes/index')."</li>";
// 	echo "          	  <li class='dropdown-submenu'>";	
// 	echo "            		  <a tabindex='-1' href='#'>Mesures</a>";	
//  	echo "           		  <ul class='dropdown-menu'>";	
// 	echo "   			  		  <li>".$this->Html->link('Evaluation à T2	','/Mesures/index')."</li>";		
// 	echo "                		  <li>".$this->Html->link('Enquête de satisfaction','/Enquetes/index')."</li>";
//  	echo "           		  </ul>";	
// 	echo "          	  </li>";	
	echo "            </ul>";
	echo "        </li>";
}	
echo "    </ul>";

//Bloc Connecté
echo "    <div class='bloc_connected'>";
echo "        <table width='100%' cellspacing='5px' cellpadding='5px'>";
echo "            <tr height='35px' align='center'>";	
echo "                <td width='70%'>".$session->read('Equipe.Libelle_Etablissement')."</td>";
echo "				  <td width='30%'>".$this->Html->link('Mon compte','/users/compte/'.$idUser,['class' => 'btn btn-default btn-sm'])."</td>";
echo "            </tr>";
echo "            <tr height='34px'  align='center'>";
echo "                <td>".$session->read('Equipe.Libelle')."</td>";
echo "                <td>".$this->Html->link('Déconnexion','/users/logout',['class' => 'btn btn-default btn-sm'])."</td>";
echo "            </tr>";
echo "        </table>";
echo "    </div>";
echo "</div>";

?>