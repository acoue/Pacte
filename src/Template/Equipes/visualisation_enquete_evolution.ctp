<?php if($nbCampagne >0) { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">	

	//Jeux de données
	google.load('visualization', '1', {packages: ['corechart', 'bar']});
	<?php 
	for($i=0;$i<10;$i++) { ?>
		var GRAPHIQUE_Q<?=$i+1?> = <?= isset($graphiques[$i]['tabGraphique'])? json_encode($graphiques[$i]['tabGraphique']) : 'undefined'; ?>;
		var GRAPHIQUE_TOTAL =  <?= isset($tabSortie)? json_encode($tabSortie) : 'undefined'; ?>;
		//Génération des graphiques
		google.setOnLoadCallback(drawGraphique<?=$i+1?>);
		function drawGraphique<?=$i+1?>() {
	        var data = new google.visualization.arrayToDataTable(GRAPHIQUE_Q<?=$i+1?>);
	        var options = {                
	                width: 500,height: 300,
	                legend: { position: 'none' },
	                chart: { title: '<?= $graphiques[$i]['titre'] ?>'},                
	                bar: { groupWidth: "90%" }
	              };        
	      	var chart = new google.charts.Bar(document.getElementById('div_graphiqueQ<?=$i+1?>'));
	      	chart.draw(data, options);
	    };

<?php } ?>
google.setOnLoadCallback(drawGraphiqueTotal);
function drawGraphiqueTotal() {
    var data = google.visualization.arrayToDataTable(GRAPHIQUE_TOTAL);

    var options = {
		width: '100%', 
		height: 600,
      	hAxis: {
        	title: 'Questions',
      	},
      	vAxis: {
        	title: '% Réponses positives'
      	}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_graphiqueTotal'));

    chart.draw(data, options);
  }
<?php
	$session = $this->request->session();	
?>
</script>
<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Visualisation des enquêtes de satisfactions</h3>
    <h4><?= $equipe->etablissement->libelle ?> - <?= $equipe->name ?></h4>
	<div class="blocblancContent">
		<div class="row">
			<div class='col-md-1'></div>
			<div class='col-md-10'>				
				<p align='center'>
				<?php 
					if($session->read('Auth.User.role') === 'admin') {
						echo $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-default']);
					} else {
						echo $this->Html->link('Retour', ['controller'=>'enquetes','action' => 'index'], ['class' => 'btn btn-default']);
					} 
				?>
				</p>
				<p align='center'>
<?php 

if($session->read('Auth.User.role') === 'admin') {
	for($i=1;$i<=$nbCampagne;$i++){		
			echo $this->Html->link(__('Campagne n°'.$i), ['controller'=>'Equipes', 'action' => 'visualisationEnquete/'.$equipe->id.'/'.$i],['class' => 'btn btn-primary'])."&nbsp;&nbsp;";
			
	}
	echo $this->Html->link(__('Evolution'), ['controller'=>'Equipes', 'action' => 'visualisationEnqueteEvolution/'.$equipe->id],['class' => 'btn btn-info','disabled'=>'disabled'])."&nbsp;&nbsp;";
	echo "<br /><br />".$this->Html->link(__('Imprimer'), ['controller'=>'Equipes', 'action' => 'imprimerEnqueteEvolution/'.$equipe->id],['class' => 'btn btn-warning']);
} 
?>		
				</p><br />
				<div class="row">
					<table  cellpadding="0" cellspacing="0" class="table">						
						<tbody>
				<?php 
					//debug($tabSortie);die();
					foreach ($tabSortie as $rep) { ?>
							<tr>
							<?php for($h=0;$h<count($rep);$h++) { 
									echo "<td><h5>".$rep[$h]."</h5></td>";
								}
							?>			
							</tr>		
				<?php } ?>						
						</tbody>
					</table>				                       
				</div><br />
				
				  <div id="chart_graphiqueTotal"></div> <br /> <br />
				  
				 
				<?php for($i=0;$i<10;$i++) { ?>
				<div id="div_graphiqueQ<?= $i+1?>" ></div><br />	
				<?php } ?>
			</div>		
			<div class='col-md-1'></div>
<?php } ?>
		</div>
	</div>
</div>
