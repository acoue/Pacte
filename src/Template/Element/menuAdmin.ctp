<?php 

$session = $this->request->session();
$username = $session->read('Auth.User.username');
$personne = $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom');
$idUser = $session->read('Auth.User.id');

echo "<div id='navbar' class='navbar-collapse collapse'>";
echo "    <ul class='nav navbar-nav'>";
echo "        <li>".$this->Html->link('Accueil','/pages/home')."</li>";
//Gestion > Admin
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
echo " 				 <li>".$this->Html->link('Envoyer un email','/users/sendMail')."</li>";
echo "            </ul>";
echo "        </li>";
echo "    </ul>";

//Bloc Connecté
echo "    <div class='bloc_connected'>";
echo "        <table width='100%' cellspacing='5px' cellpadding='5px'>";
echo "            <tr height='35px' align='center'>";	
echo "                <td width='70%'>".$personne."</td>";
echo "				  <td width='30%'>".$this->Html->link('Mon compte','/users/compte/'.$idUser,['class' => 'btn btn-default btn-sm'])."</td>";
echo "            </tr>";
echo "            <tr height='34px'  align='center'>";
echo "                <td>".$username." (Administrateur)</td>";
echo "                <td>".$this->Html->link('Déconnexion','/users/logout',['class' => 'btn btn-default btn-sm'])."</td>";
echo "            </tr>";
echo "        </table>";
echo "    </div>";
echo "</div>";

?>