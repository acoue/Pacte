<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'bootstrap.css'?>" >
<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'style.css'?>">
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

<?php } ?>
</script>
<table width="100%" border="0" >
	<tr width="10%">
		<td rowspan='2'><img src='<?= WWW_ROOT.'img'.DS .'logo.jpg' ?>'/></td>
		<td><h3>Résultats des enquêtes de satisfaction (Evolution) de : <?= $equipe->etablissement->libelle ?> - Equipe <?= $equipe->name?></h3></td>
	</tr>
	<tr>
		<td><p><h5>Date d'édition : <?= date('d/m/Y à H:i:s')?></h5></p></td>
	</tr>
</table>
<br /><br />
<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Visualisation des enquêtes de satisfactions</h3>
    <h4><?= $equipe->etablissement->libelle ?> - <?= $equipe->name ?></h4>
</div>	
<div class="blocblanc">	
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
	<div id="div_graphiqueQ<?= $i+1?>" style="width: 60%; height: 400px;"></div><br /><br />	
	<?php } ?>
	
	
</div>
