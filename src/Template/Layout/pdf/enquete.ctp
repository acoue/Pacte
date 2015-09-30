<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'bootstrap.css'?>" >
<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'style.css'?>">
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
          width: '100%', height: 500,           
          chart: {
            title: '<?= $graphique1['titre'] ?>',
            subtitle: '<?= $graphique1['sousTitre'] ?>'
          },          
          axes: {
            y: {
            	valeur1: {label: '<?=  $graphique1['labelYGauche'] ?>'}
            }
          }
        };

      var chart = new google.charts.BarChart(document.getElementById('div_graphique1'));
      chart.draw(data, options);
    };


    function drawGraphique2() {
    	var data = new google.visualization.arrayToDataTable(GRAPHIQUE_2);

        var options = {
            width: '100%', height: 500,
			chart: {
            	title: '<?= $graphique2['titre'] ?>',
                subtitle: '<?= $graphique2['sousTitre'] ?>',
            }, 
            chartArea: {              
                width: '50%' 
            },                   
			hAxis: {
            	title: '<?= $graphique2['labelX'] ?>',
          	}
        };

        var chart = new google.visualization.BarChart(document.getElementById('div_graphique2'));
        chart.draw(data, options);
      }

    function drawGraphique3() {
		var data = new google.visualization.arrayToDataTable(GRAPHIQUE_3);

    	var options = {
			title: '<?= $graphique3['titre'] ?>',
            subtitle: '<?= $graphique3['sousTitre'] ?>',
            width: '100%',
           	bar: {groupWidth: '95%'},
       	    legend: { position: 'none' },
		};
    		
    	
        var chart = new google.visualization.ColumnChart(document.getElementById('div_graphique3'));
        chart.draw(data, options);
    }
    
</script>
<table width="100%" border="0" >
	<tr width="10%">
		<td rowspan='2'><img src='<?= WWW_ROOT.'img'.DS .'logo.jpg' ?>'/></td>
		<td><h3>Résultats des enquêtes de satisfaction de : <?= $equipe->etablissement->libelle ?> - Equipe <?= $equipe->name?></h3></td>
	</tr>
	<tr>
		<td><p><h5>Date d'édition : <?= date('d/m/Y à H:i:s')?></h5></p></td>
	</tr>
</table>
<br /><br />
<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Visualisation des enquêtes de satisfactions</h3>
    <h4><?= $equipe->etablissement->libelle ?> - <?= $equipe->name ?> - Campagne n° <?= $campagne ?></h4>
</div>	
<div class="blocblanc">	
	<table  cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th width='50%'><h5><b>Questions</b></th>
				<th width='10%'><h5>Tout à fait d'accord</h5></th>
				<th width='10%'><h5>Plutôt d'accord</h5></th>
				<th width='10%'><h5>Plutôt pas d'accord</h5></th>
				<th width='10%'><h5>Pas du tout d'accord</h5></th>
				<th width='10%'><h5>NSP</h5></th>
			</tr>
		</thead>
		<tbody>
<?php foreach ($tabReponse as $rep) { ?>
			<tr>
				<td><h5><?= $rep[0]?></td>
				<td><h5><?= round($rep[1], 1);?></h5></td>
				<td><h5><?= round($rep[2], 1);?></h5></td>
				<td><h5><?= round($rep[3], 1);?></h5></td>
				<td><h5><?= round($rep[4], 1);?></h5></td>
				<td><h5><?= round($rep[5], 1);?></h5></td>
			</tr>		
<?php } ?>						
		</tbody>
	</table><br /><br />	
	<div id="div_graphique1"></div><br /><br />
	<div id="div_graphique2"></div><br /><br />
	<table cellpadding="0" cellspacing="0" class="table table-striped">						
		<tbody>
<?php foreach ($tabReponseType2 as $rep2) { ?>
			<tr>
				<td width='50%'><h5><?= $rep2[0]?></h5></td>
				<td><h5><?= round($rep2[1], 1);?></h5></td>
				<td><h5><?= round($rep2[2], 1);?></h5></td>
				<td><h5><?= round($rep2[3], 1);?></h5></td>
				<td><h5><?= round($rep2[4], 1);?></h5></td>
				<td><h5><?= round($rep2[5], 1);?></h5></td>
				<td><h5><?= round($rep2[6], 1);?></h5></td>
				<td><h5><?= round($rep2[7], 1);?></h5></td>
				<td><h5><?= round($rep2[8], 1);?></h5></td>
				<td><h5><?= round($rep2[9], 1);?></h5></td>
			</tr>		
<?php } ?>						
		</tbody>
	</table><br /><br />         
	<div id="div_graphique3" style="width: 100%; height: 400px; "></div>
</div>
