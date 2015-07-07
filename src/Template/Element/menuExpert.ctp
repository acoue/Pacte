<?php 

$session = $this->request->session();

$username = $session->read('Auth.User.username');
$personne = $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom');
$idUser = $session->read('Auth.User.id');

echo "<div id='navbar' class='navbar-collapse collapse'>";
echo "    <ul class='nav navbar-nav'>";
echo "        <li>".$this->Html->link('Accueil','/pages/home')."</li>";
echo "    </ul>";
//Bloc Connecté
echo "    <div class='bloc_connected'>";
echo "        <table width='100%' cellspacing='5px' cellpadding='5px'>";
echo "            <tr height='35px' align='center'>";	
echo "                <td width='70%'>".$personne."</td>";
echo "				  <td width='30%'>".$this->Html->link('Mon compte','/users/compte/'.$idUser,['class' => 'btn btn-default btn-sm'])."</td>";
echo "            </tr>";
echo "            <tr height='34px'  align='center'>";
echo "                <td>".$username." (Expert Visiteur)</td>";
echo "                <td>".$this->Html->link('Déconnexion','/users/logout',['class' => 'btn btn-default btn-sm'])."</td>";
echo "            </tr>";
echo "        </table>";
echo "    </div>";
echo "</div>";


?>