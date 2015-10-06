<?php if($nbCampagne >0) { ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">	

	//Jeux de données

	var GRAPHIQUE_1 = <?= isset($graphique1['tabGraphique'])? json_encode($graphique1['tabGraphique']) : 'undefined'; ?>;
	var GRAPHIQUE_2 = <?= isset($graphique2['tabGraphique'])? json_encode($graphique2['tabGraphique']) : 'undefined'; ?>;
	var GRAPHIQUE_3 = <?= isset($graphique3['tabGraphique'])? json_encode($graphique3['tabGraphique']) : 'undefined'; ?>;
	
	//Type de graphique
	google.load('visualization', '1', {packages: ['corechart', 'bar']});

	//Génération des graphiques
	google.setOnLoadCallback(drawGraphique1);
	google.setOnLoadCallback(drawGraphique2);
	google.setOnLoadCallback(drawGraphique3);

	function drawGraphique1() {
        var data = new google.visualization.arrayToDataTable(GRAPHIQUE_1);

	    var options = {
		    	title: '<?= $graphique1['titre'] ?>',
	            subtitle: '<?= $graphique1['sousTitre'] ?>',
	            legend: { position: 'top', maxLines: 3 },
	            width: '100%',
	            height: 500,
		        vAxis: {
		          title: '<?= $graphique1['labelYGauche'] ?>'
		        }
		      };

		      var chart = new google.visualization.ColumnChart(document.getElementById('div_graphique1'));
		      chart.draw(data, options);
    };


    function drawGraphique2() {
    	var data = new google.visualization.arrayToDataTable(GRAPHIQUE_2);

		var options = {    			
    			width: '90%', 
    			height: 500,
    	        chart: {
    	            title: '<?= $graphique2['titre'] ?>',
    	            subtitle: '<?= $graphique2['sousTitre'] ?>',groupWidth: '95%',
    	         },
    	         bars: 'horizontal' // Required for Material Bar Charts.
    	};

        var chart = new google.charts.Bar(document.getElementById('div_graphique2'));
        chart.draw(data, options);  
    	      
      }

    function drawGraphique3() {
		var data = new google.visualization.arrayToDataTable(GRAPHIQUE_3);

    	var options = {
			title: '<?= $graphique3['titre'] ?>',
            subtitle: '<?= $graphique3['sousTitre'] ?>',
            width: '100%',  
			height: 500,           
           	bar: {groupWidth: '95%'},
       	    legend: { position: 'none' },
		};
    		
    	
        var chart = new google.visualization.ColumnChart(document.getElementById('div_graphique3'));
        chart.draw(data, options);
    }
    
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
	for($i=1;$i<=$nbCampagne;$i++){
		if($i != $campagne) {
			echo $this->Html->link(__('Campagne n°'.$i), ['controller'=>'Equipes', 'action' => 'visualisationEnquete/'.$equipe->id.'/'.$i],['class' => 'btn btn-primary'])."&nbsp;&nbsp;";
		} else {
			echo $this->Html->link(__('Campagne n°'.$i), ['controller'=>'Equipes', 'action' => 'visualisationEnquete/'.$equipe->id.'/'.$i],['class' => 'btn btn-primary','disabled'=>'disabled'])."&nbsp;&nbsp;";
		}		
	}
	
	echo $this->Html->link(__('Evolution'), ['controller'=>'Equipes', 'action' => 'visualisationEnqueteEvolution/'.$equipe->id],['class' => 'btn btn-info'])."&nbsp;&nbsp;";
	echo "<br /><br />".$this->Html->link(__('Imprimer'), ['controller'=>'Equipes', 'action' => 'imprimerEnquete/'.$equipe->id.'/'.$campagne],['class' => 'btn btn-warning']);
	
	
?>		
				</p><br />
				<div class="row">
					<table cellpadding="0" cellspacing="0" class="table table-striped">
						<thead>
							<tr>
								<th width='50%'><b>Questions</b></th>
								<th width='10%'>Tout à fait d'accord</th>
								<th width='10%'>Plutôt d'accord</th>
								<th width='10%'>Plutôt pas d'accord</th>
								<th width='10%'>Pas du tout d'accord</th>
								<th width='10%'>NSP</th>
							</tr>
						</thead>
						<tbody>
				<?php foreach ($tabReponse as $rep) { ?>
							<tr>
								<td><?= $rep[0]?></td>
								<td><?= round($rep[1], 1);?></td>
								<td><?= round($rep[2], 1);?></td>
								<td><?= round($rep[3], 1);?></td>
								<td><?= round($rep[4], 1);?></td>
								<td><?= round($rep[5], 1);?></td>
							</tr>		
				<?php } ?>						
						</tbody>
					</table>	                       
				</div><br />
				<div class="row">
				<div id="div_graphique1" ></div><br /><br />
				<div id="div_graphique2" ></div><br /><br />
				</div>
				<div class="row">
					<table cellpadding="0" cellspacing="0" class="table table-striped">						
						<tbody>
				<?php foreach ($tabReponseType2 as $rep2) { ?>
							<tr>
								<td width='50%'><?= $rep2[0]?></td>
								<td><?= round($rep2[1], 1);?></td>
								<td><?= round($rep2[2], 1);?></td>
								<td><?= round($rep2[3], 1);?></td>
								<td><?= round($rep2[4], 1);?></td>
								<td><?= round($rep2[5], 1);?></td>
								<td><?= round($rep2[6], 1);?></td>
								<td><?= round($rep2[7], 1);?></td>
								<td><?= round($rep2[8], 1);?></td>
								<td><?= round($rep2[9], 1);?></td>
							</tr>		
				<?php } ?>						
						</tbody>
					</table>	                       
				</div><br />
				<div id="div_graphique3""></div>
			</div>		
			<div class='col-md-1'></div>
		</div>
	</div>
</div>		
<?php } else {
	echo "<p align='center'>";
	echo $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-default']);
	echo "</p>";	
}?>	
