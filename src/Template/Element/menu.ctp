<?php 

$session = $this->request->session();
if($session->check('User.Role')) { 

	$role = $session->read('User.Role');
	
	echo "<div id='navbar' class='navbar-collapse collapse'>";
	echo "    <ul class='nav navbar-nav'>";
if($role === 'admin' || $role === 'equipe')	echo "        <li class='dropdown'>";
if($role === 'admin' || $role === 'equipe')	echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Gestion <span class='caret'></span></a>";
if($role === 'admin' || $role === 'equipe')	echo "            <ul class='dropdown-menu' role='menu'>";
//Gestion > Admin
if($role === 'admin')	echo " <li>".$this->Html->link('Utilisateur','/users/index')."</li>";
if($role === 'admin')	echo " <li>".$this->Html->link('Paramètres','/parametres/index')."</li>";
if($role === 'admin')	echo " <li>".$this->Html->link('Outils','/outils/index')."</li>";
if($role === 'admin')	echo " <li>".$this->Html->link('Questions','/questions/index')."</li>";
//Gestion > Equipe
if($role === 'equipe')	echo " <li><a href='#'>Membre</a></li>";
if($role === 'equipe')	echo " <li><a href='#'>Comité de pilotage</a></li>";
if($role === 'admin' || $role === 'equipe')	echo "            </ul>";
if($role === 'admin' || $role === 'equipe')	echo "        </li>";
	echo "        <li class='dropdown'>";
	echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Suivi <span class='caret'></span></a>";
	echo "            <ul class='dropdown-menu' role='menu'>";
	echo "                <li><a href='#'>Engagement</a></li>";
	echo "                <li><a href='#'>Démarches</a></li>";
	echo "            </ul>";
	echo "        </li>";
	echo "    </ul>";
	echo "    <div class='bloc_connected'>";
	echo "        <table width='100%' cellspacing='5px' cellpadding='5px'>";
	echo "            <tr height='35px' align='center'>";
if($role === 'equipe')		echo "                <td width='70%'>Libelle ES</td>";
if($role === 'admin' || $role === 'expert' || $role === 'has')		echo "                <td width='70%'>Connecté en tant que : </td>";
	echo "				  <td width='30%'>".$this->Html->link('Mon compte','/users/compte',['class' => 'btn btn-default btn-sm'])."</td>";
	echo "            </tr>";
	echo "            <tr height='34px'  align='center'>";
if($role === 'equipe')			echo "                <td>Libelle Equipe</td>";
if($role === 'admin')			echo "                <td>Administrateur</td>";
if($role === 'has')				echo "                <td>Chef de projet HAS</td>";
if($role === 'expert')			echo "                <td>Expert Visiteur</td>";
	echo "                <td>".$this->Html->link('Déconnexion','/users/logout',['class' => 'btn btn-default btn-sm'])."</td>";
	echo "            </tr>";
	echo "        </table>";
	echo "    </div>";
	echo "</div>";
} else { 
	echo "<div id='navbar' class='navbar-collapse collapse'>";
	echo "    <ul class='nav navbar-nav'>";
	echo "        <li>".$this->Html->link('S\'identifier','/users/login')."</li>";		
	echo "        <li>".$this->Html->link('Contact','/contact/index')."</li>";
	echo "    </ul>";
	echo "</div>";
}

/*
 * Menu Admin : 
 * - gestion > User
 * - gestion > Paramètres 
 * - gestion > Outil 
 * - gestion > questions / aide 
 * - Visualisation > Engagement 
 * - Repartition CP - Equipe
 * - Mon compte
 * 
 * 
/*
 * Menu Equipe :
 * - gestion > Membre
 * - gestion > Conseil
 * - Projet > Engagement
 * - Projet > diagnostic 
 * - Mon compte
 *
 * * Menu HAS  
 * - Situation Equipe
 * - Repartition EV - Equipe
 * 
 * Menu Expert  
 * - Situation Equipe
 * - Evaluation
 * */
?>