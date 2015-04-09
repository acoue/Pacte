<?php 
$session = $this->request->session();
//echo $session->Auth->User->role;
//echo "==>".$session->read('User.Role');

if($session->check('User.Role')) { 
	echo "<div id='navbar' class='navbar-collapse collapse'>";
	echo "Connecté en tant que ".$session->read('User.Role');
	echo "    <ul class='nav navbar-nav'>";
	echo "        <li class='dropdown'>";
	echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Gestion <span class='caret'></span></a>";
	echo "            <ul class='dropdown-menu' role='menu'>";
	echo "                <li><a href='#'>Utilisateur</a></li>";
	echo "                <li><a href='#'>Paramètres</a></li>";
	echo "                <li><a href='#'>Formulaire</a></li>";
	echo "            </ul>";
	echo "        </li>";
	echo "        <li class='dropdown'>";
	echo "            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Suivi <span class='caret'></span></a>";
	echo "            <ul class='dropdown-menu' role='menu'>";
	echo "                <li><a href='#'>Engagement</a></li>";
	echo "                <li><a href='#'>Démarches</a></li>";
	echo "            </ul>";
	echo "        </li>";
	echo "        <li><a href='#contact'>Contact</a></li>";
	echo "    </ul>";
	echo "    <div class='bloc_connected'>";
	echo "        <table width='100%' cellspacing='5px' cellpadding='5px'>";
	echo "            <tr height='35px' align='center'>";
	echo "                <td width='70%'>Libelle ES</td>";
	echo "                <td width='30%'><a class='btn btn-default btn-sm' title='Valider' href='#'>Mon compte</a></td>";
	echo "            </tr>";
	echo "            <tr height='34px'  align='center'>";
	echo "                <td>Libelle Equipe</td>";
	echo "                <td>".$this->Html->link('Déconnexion','/users/logout',['class' => 'btn btn-default btn-sm'])."</td>";
	echo "            </tr>";
	echo "        </table>";
	echo "    </div>";
	echo "</div>";
} else { 
	echo "<div id='navbar' class='navbar-collapse collapse'>";
	echo "    <ul class='nav navbar-nav'>";
	echo "        <li>".$this->Html->link('S\'identifier','/users/login')."</li>";	
	echo "        <li><a href='#contact'>Contact</a></li>";
	echo "    </ul>";
	echo "</div>";
}

?>