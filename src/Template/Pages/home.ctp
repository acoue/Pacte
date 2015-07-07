<?php
$session = $this->request->session();

if($session->check('Auth.User.role')) {
	$role = $session->read('Auth.User.role');
	
	if($role === 'admin') {?>
		<p>Bienvenue <?= $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom') ?></p>
		<p><?= $message->valeur; ?>
		<br /><br />
		<table cellpadding="0" cellspacing="0" class="table">
			<caption>Liste des équipes </caption>
		    <tbody>
		    <?php foreach ($equipes as $equipe): ?>
		        <tr>
		            <td width='35%'><?= $equipe->etablissement->libelle ?></td>
		            <td width='30%'><?= $equipe->name ?></td>
		            <td width='15%'><?= $this->Html->link('Etat de la démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$equipe->id],['class' => 'btn btn-default']) ?></td>	
		            <td width='15%'><?= $this->Html->link('Générer un PDF', ['controller'=>'Equipes', 'action' => 'visualisation/1/'.$equipe->id],['class' => 'btn btn-info']) ?></td>	            
		        </tr>		
		    <?php endforeach; ?>
		    </tbody>
	    </table>	    
<?php
	} else if($role === 'has') {
		echo "<p>".$message->valeur."</p>";
	} else if($role === 'expert') { ?>
		<p>Bienvenue <?= $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom') ?></p>
		<p><?= $message->valeur; ?>
		<br /><br />
		<table cellpadding="0" cellspacing="0" class="table">
			<caption>Liste des équipes dont vous pouvez voir l'état des démarches</caption>
		    <tbody>
		    <?php foreach ($equipeUsers as $eqUse): ?>
		        <tr>
		            <td width='35%'><?= $eqUse->equipe->etablissement->libelle ?></td>
		            <td width='30%'><?= $eqUse->equipe->name ?></td>
		            <td width='15%'><?= $this->Html->link('Etat de la démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$eqUse->equipe->id],['class' => 'btn btn-default']) ?></td>	
		            <td width='15%'><?= $this->Html->link('Générer un PDF', ['controller'=>'Equipes', 'action' => 'visualisation/1/'.$eqUse->equipe->id],['class' => 'btn btn-info']) ?></td>	            
		        </tr>		
		    <?php endforeach; ?>
		    </tbody>
	    </table>	    
<?php
		
	} else if($role === 'equipe') {
		echo "<p>".$message->valeur."</p>";
		
		//Bouton suivant la phase
		if($session->read('Equipe.Engagement') == 0 ){
			echo $this->Html->link('Poursuivre l\'engagement', ['controller'=>'membres', 'action' => 'index/0/1'],['class' => 'btn btn-info']);
		}else if($session->read('Equipe.Diagnostic') == 0 ){
			echo $this->Html->link('Poursuivre dans la phase de diagnostic', ['controller'=>'projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info']);
		} else if($session->read('Equipe.MiseEnOeuvre') == 0 ){
			echo $this->Html->link('Terminer la phase de mise en oeuvre', ['controller'=>'Projets', 'action' => 'terminateMEO'],['class' => 'btn btn-info']);
		} else if($session->read('Equipe.Evaluation') == 0 ){
			echo "<p>Voir si bouton de clôture de la démarche</p>";	
		} 
	}
}
if($role === 'admin') {
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	var GLOBALES_PHP = <?= isset($tab_globales)? json_encode($tab_globales) : 'undefined'; ?>;
	google.load("visualization", "1.1", {packages:["bar"]});
	google.setOnLoadCallback(drawStuff);

	function drawStuff() {
        var data = new google.visualization.arrayToDataTable(GLOBALES_PHP);
        var options = {
          width: 900,
          chart: {
            title: '<?= $titre ?>',
            subtitle: '<?= $sousTitre ?>'
          },
          series: {
            0: { axis: 'valeur1' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'valeur2' }, // Bind series 1 to an axis named 'brightness'.
            2: { axis: 'valeur3' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
            	valeur1: {label: '<?= $labelYGauche ?>'}, // Left y-axis.
            	valeur2: {side: 'right', label: '<?= $labelYDroit ?>'} // Right y-axis.
            }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('dual_y_div'));
      chart.draw(data, options);
    };
</script>
<br /><br />
<div id="dual_y_div" style="width: 500px; height: 300px;"></div>



<?php }?>



