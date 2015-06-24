<?php 

$session = $this->request->session();
if($session->check('Auth.User.role')) { 

	$role = $session->read('Auth.User.role');
	$username = $session->read('Auth.User.username');
	$personne = $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom');
	
	if($session->check('Equipe.Engagement')) $etat_engagement = $session->read('Equipe.Engagement');
	if($session->check('Equipe.Diagnostic')) $etat_diagnostic = $session->read('Equipe.Diagnostic');
	else $etat_diagnostic = 0;
	if($session->check('Equipe.MiseEnOeuvre')) $etat_oeuvre = $session->read('Equipe.MiseEnOeuvre');
	else $etat_oeuvre = 0;
	if($session->check('Equipe.Evaluation')) $etat_evaluation = $session->read('Equipe.Evaluation');
	else $etat_evaluation = 0;
	
	echo "<div id='navbar' class='navbar-collapse collapse'>";
	echo "    <ul class='nav navbar-nav'>";
	
	//Gestion > Admin
	if($role === 'admin') {
			echo "        <li class='dropdown'>";
			echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Gestion <span class='caret'></span></a>";
			echo "            <ul class='dropdown-menu' role='menu'>";
			echo "				 <li>".$this->Html->link('Etablissements','/etablissements/index')."</li>";
			echo "				 <li>".$this->Html->link('Fonctions','/fonctions/index')."</li>";
			echo " 				 <li>".$this->Html->link('Outils','/outils/index')."</li>";
			echo " 				 <li>".$this->Html->link('Paramètres','/parametres/index')."</li>";
			echo "				 <li>".$this->Html->link('Questions','/questions/index')."</li>";
			echo "				 <li>".$this->Html->link('Questions Enquête','/EnqueteQuestions/index')."</li>";
			echo "				 <li>".$this->Html->link('Type Indicateurs','/typeIndicateurs/index')."</li>";
			echo " 				 <li>".$this->Html->link('Utilisateur','/users/index')."</li>";
			echo "            </ul>";
			echo "        </li>";
			echo "        <li class='dropdown'>";
			echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Relations <span class='caret'></span></a>";
			echo "            <ul class='dropdown-menu' role='menu'>";
			echo " 				 <li>".$this->Html->link('Equipes / Utilisateurs','/EquipesUsers/index')."</li>";
			echo "            </ul>";
			echo "        </li>";
			echo "        <li class='dropdown'>";
			echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Suivi <span class='caret'></span></a>";
			echo "            <ul class='dropdown-menu' role='menu'>";
			echo " 				 <li>".$this->Html->link('Démarches','/pages/home')."</li>";
			echo "            </ul>";
			echo "        </li>";
	}
	//Gestion > Equipe
	if($role === 'equipe' && $etat_engagement == 1 ) {	
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

	if($role === 'equipe' && $etat_engagement == 1 && $etat_diagnostic == 0 ) {
			echo "        <li>".$this->Html->link('Diagnostic','/projets/diagnostic_index')."</li>";
	}
	
	if($role === 'equipe' && $etat_engagement == 1 && $etat_diagnostic == 1 && $etat_oeuvre == 0) {	
			echo "        <li class='dropdown'>";
			echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Diagnostic <span class='caret'></span></a>";
			echo "            <ul class='dropdown-menu' role='menu'>";
			echo "                <li>".$this->Html->link('Projet','/projets/diagnostic_index')."</li>";
			echo " 				  <li>".$this->Html->link('Fonctionnement d\'équipe','/Evaluations/index')."</li>";
			echo "            </ul>";
			echo "        </li>";
			echo "        <li class='dropdown'>";
			echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Mise en Oeuvre <span class='caret'></span></a>";
			echo "            <ul class='dropdown-menu' role='menu'>";
			echo " 				  <li>".$this->Html->link('Objectifs d\'amélioration','/PlanActions/index')."</li>";
			echo "   			  <li>".$this->Html->link('Evaluation à T0','/Mesures/index')."</li>";
			echo "                <li>".$this->Html->link('Enquête de satisfaction','/Enquetes/index')."</li>";
			echo "            </ul>";
			echo "        </li>";
	}

	if($role === 'equipe' && $etat_engagement == 1 && $etat_diagnostic == 1 && $etat_oeuvre == 1 && $etat_evaluation == 0 ) {
		echo "        <li class='dropdown'>";
		echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Diagnostic <span class='caret'></span></a>";
		echo "            <ul class='dropdown-menu' role='menu'>";
		echo "                <li>".$this->Html->link('Projet','/projets/diagnostic_index')."</li>";
		echo " 				  <li>".$this->Html->link('Fonctionnement d\'équipe','/Evaluations/index')."</li>";
		echo "            </ul>";
		echo "        </li>";
		echo "        <li class='dropdown'>";
		echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Mise en Oeuvre <span class='caret'></span></a>";
		echo "            <ul class='dropdown-menu' role='menu'>";
		echo " 				  <li>".$this->Html->link('Objectifs d\'amélioration','/PlanActions/index')."</li>";
		echo "        </li>";
		echo "        <li class='dropdown'>";
		echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Evaluation <span class='caret'></span></a>";
		echo "            <ul class='dropdown-menu' role='menu'>";
		echo "   			  <li>".$this->Html->link('Evaluation à T0','/Mesures/index')."</li>";
		echo "                <li>".$this->Html->link('Enquête de satisfaction','/Enquetes/index')."</li>";
		echo "            </ul>";
		echo "        </li>";
	}

	//Gestion > Admin
	if($role === 'expert') {
		echo "        <li>".$this->Html->link('Accueil','/pages/home')."</li>";
	}
	echo "    </ul>";

	
	
	
	
	//Bloc Connecté
	echo "    <div class='bloc_connected'>";
	echo "        <table width='100%' cellspacing='5px' cellpadding='5px'>";
	echo "            <tr height='35px' align='center'>";
	
	if($role === 'equipe')		echo "                <td width='70%'>".$session->read('Equipe.Libelle_Etablissement')."</td>";

	if($role === 'admin' || $role === 'expert' || $role === 'has')		echo "                <td width='70%'>".$personne."</td>";
	echo "				  <td width='30%'>".$this->Html->link('Mon compte','/users/compte',['class' => 'btn btn-default btn-sm'])."</td>";
	echo "            </tr>";
	echo "            <tr height='34px'  align='center'>";
	if($role === 'equipe')			echo "                <td>".$session->read('Equipe.Libelle')."</td>";
	if($role === 'admin')			echo "                <td>".$username." (Administrateur)</td>";
	if($role === 'has')				echo "                <td>".$username." (Chef de projet HAS)</td>";
	if($role === 'expert')			echo "                <td>".$username." (Expert Visiteur)</td>";
	echo "                <td>".$this->Html->link('Déconnexion','/users/logout',['class' => 'btn btn-default btn-sm'])."</td>";
	echo "            </tr>";
	echo "        </table>";
	echo "    </div>";
	echo "</div>";

//Non connecté
} else { 
	echo "<div id='navbar' class='navbar-collapse collapse'>";
	echo "    <ul class='nav navbar-nav'>";
	echo "        <li>".$this->Html->link('S\'identifier','/users/login')."</li>";		
	echo "        <li>".$this->Html->link('Contact','/contact/index')."</li>";
	echo "    </ul>";
	echo "</div>";
}
?>