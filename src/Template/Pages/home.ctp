<?php
$session = $this->request->session();

if($session->check('Auth.User.role')) {
	$role = $session->read('Auth.User.role');
	
	if($role === 'admin') {?>
		<p>Bienvenue <?= $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom') ?></p>
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
		echo "Bienvenue Chef de Projet HAS";
	} else if($role === 'expert') { ?>
		<p>Bienvenue <?= $session->read('Auth.User.prenom')." ".$session->read('Auth.User.nom') ?></p>
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
		if($session->read('Equipe.Engagement') == 0 ){
			echo $this->Html->link('Poursuivre l\'engagement', ['controller'=>'membres', 'action' => 'index/0/1'],['class' => 'btn btn-info']);
			
		}else if($session->read('Equipe.Diagnostic') == 0 ){
			echo $this->Html->link('Poursuivre dans la phase de diagnostic', ['controller'=>'projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info']);
			
		} else if($session->read('Equipe.MiseEnOeuvre') == 0 ){
			
			
//  			echo $this->Chartjs->createChart([
//  					'Chart' => ['id' => 'myBarChart','type' => 'bar'],
//  					'Data' => $dataChart,
//  					'Options' => ['Bar' => ['scaleShowGridLines' => false],'responsive' => true]]);
			
			echo "<p>Pensez bien à remplir l'enquête de satisfaction initiale</p>";	
			echo $this->Html->link('Terminer la phase de mise en oeuvre', ['controller'=>'', 'action' => ''],['class' => 'btn btn-info']);
			
		} 
		else echo "Bienvenue Equipe";
		
		
		
		
		
		
	}
}
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1],
        [{v: [9, 0, 0], f: '9 am'}, 2],
        [{v: [10, 0, 0], f:'10 am'}, 3],
        [{v: [11, 0, 0], f: '11 am'}, 4],
        [{v: [12, 0, 0], f: '12 pm'}, 5],
        [{v: [13, 0, 0], f: '1 pm'}, 6],
        [{v: [14, 0, 0], f: '2 pm'}, 7],
        [{v: [15, 0, 0], f: '3 pm'}, 8],
        [{v: [16, 0, 0], f: '4 pm'}, 9],
        [{v: [17, 0, 0], f: '5 pm'}, 10],
      ]);

      var options = {
        title: 'Titre du graphique',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>
<div id="chart_div" ></div>


