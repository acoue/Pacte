<?php if($nbCampagne >0) { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">	

	//Jeux de données
	google.load('visualization', '1', {packages: ['corechart', 'bar']});
	<?php for($i=0;$i<10;$i++) { ?>
	var GRAPHIQUE_Q<?=$i+1?> = <?= isset($graphiques[$i]['tabGraphique'])? json_encode($graphiques[$i]['tabGraphique']) : 'undefined'; ?>;
	//Génération des graphiques
	google.setOnLoadCallback(drawGraphique<?=$i+1?>);
		
	function drawGraphique<?=$i+1?>() {
        var data = new google.visualization.arrayToDataTable(GRAPHIQUE_Q<?=$i+1?>);
        var options = {                
                width: '50%',
                legend: { position: 'none' },
                chart: { title: '<?= $graphiques[$i]['titre'] ?>'},                
                bar: { groupWidth: "90%" }
              };        
      	var chart = new google.charts.Bar(document.getElementById('div_graphiqueQ<?=$i+1?>'));
      	chart.draw(data, options);
    };

	<?php } 
}?>
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
				<?= $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-default']) ?>
				</p>
				<p align='center'>
<?php 
if($nbCampagne >0) {
	for($i=1;$i<=$nbCampagne;$i++){
		
			echo $this->Html->link(__('Campagne n°'.$i), ['controller'=>'Equipes', 'action' => 'visualisationEnquete/'.$equipe->id.'/'.$i],['class' => 'btn btn-primary'])."&nbsp;&nbsp;";
			
	}
	echo $this->Html->link(__('Evolution'), ['controller'=>'Equipes', 'action' => 'visualisationEnqueteEvolution/'.$equipe->id],['class' => 'btn btn-info','disabled'=>'disabled'])."&nbsp;&nbsp;";
	
?>		
				</p><br />
				<div class="row">
					<table cellpadding="0" cellspacing="0" class="table table-striped">						
						<tbody>
				<?php foreach ($tabSortie as $rep) { ?>
							<tr>
								<td width='55%'><?= $rep[0]?></td>
								<td><?= $rep[1]?></td>
								<td><?= $rep[2]?></td>
								<td><?= $rep[3]?></td>							
							</tr>		
				<?php } ?>						
						</tbody>
					</table>	    
					                       
				</div><br />
				<?php for($i=0;$i<10;$i++) { ?>
				<div id="div_graphiqueQ<?= $i+1?>" style="width: 60%; height: 400px;"></div><br />	
				<?php } ?>
			</div>		
			<div class='col-md-1'></div>
<?php } ?>
		</div>
	</div>
</div>
