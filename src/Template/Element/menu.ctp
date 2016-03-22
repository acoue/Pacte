<?php 

echo "<div id='navbar' class='navbar-collapse collapse'>";
echo "    <ul class='nav navbar-nav'>";
echo "        <li>".$this->Html->link('S\'identifier','/users/login')."</li>";		
echo "        <li>".$this->Html->link('Contact','/contact/index')."</li>";		
//echo "        <li>".$this->Html->link('Outil CRM','/crm/index')."</li>";
echo "    </ul>";
echo "</div>";

?>