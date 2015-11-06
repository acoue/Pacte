<?php if($nbEnquete > 0) {  ?>
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

      var chart = new google.charts.Bar(document.getElementById('div_graphique1'));
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
<?php } ?>


<div class="blocblanc">
<?php 
$session = $this->request->session();
if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
	<h2>Phase de mise en oeuvre et de suivi</h2>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
	<h2>Phase d'évaluation</h2>
<?php } ?>

    <h3>Enquêtes de satisfaction</h3>    
	<div class="blocblancContent"> 
		<div class="row"> 
			<div class="col-md-1"></div>
			<div class="col-md-11">
			<?= $message->valeur ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 				
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<p>
						<?php 
						//Affichage du nombre d'enquete
							if ($nbEnquete == 0) echo "<p>A ce jour, votre équipe n'a pas encore réalisé d'enquête.</p>"; 
							else if ($nbEnquete == 1) echo "<p>Sur la campgane n°".$campagne.", votre équipe a réalisé une enquête.</p>";
							else echo "<p>Sur la campgane n°".$campagne.", votre équipe a répondu à ".$nbEnquete." enquêtes.</p>";
						
							//affichage de la date de l'enquete max
							if($nbEnquete > 0 && $dateMax->count()>0){
								foreach ($dateMax as $dm):							
									$datetime1 = new DateTime($dm->max);
									$datetime2 = new DateTime("now");
									$interval = $datetime1->diff($datetime2);										
									$dateAffiche = strftime('%d/%m/%y', strtotime($dm->max));
									//$diffDate =  date_diff(DateTime($dm->max), date('Y-m-d'));
									if($interval->format('%a') < 365) {
										echo "<p class='alert alert-info'>Date de la dernière enquête pour l'équipe sur la campagne n°".$campagne." ".$dm->service." : ".$dateAffiche." - ".$interval->format('%a')." jour(s)</p>";
									} else {
										echo "<p class='alert alert-warning'>Attention : la date de la dernière enquête pour l'équipe ".$dm->service." : ".$dateAffiche." - ".$interval->format('%a')." jours</p>";
									}
								endforeach;	
							} 	
							?>
						</p>
					</div>
					<div class="col-md-1"></div>
				</div>
				<p align="center">
					<?php echo $this->Html->link(__('Remplir une nouvelle enquête'), ['action' => 'add'], ['class'=>'btn btn-default']);
					echo "<br /><br />";
					echo $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-info']); ?>	
				</p>
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='20%'><?= $this->Paginator->sort('Campagne', 'Campagne n°') ?></th>
				            <th width='40%'><?= $this->Paginator->sort('Service') ?></th>
				            <th width='20%'><?= $this->Paginator->sort('Créée le','Créée le') ?></th>
				            <th  width='20%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($enquetes as $enquete): ?>
				        <tr>
				            <td><?= h($enquete->campagne) ?></td>
				            <td><?= h($enquete->service) ?></td>
				            <td><?= h($enquete->created) ?></td>
					        <td class="actions">
							<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $enquete->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;
							<?= $this->Form->postLink(
							                '<span><i class="glyphicon glyphicon-trash"></i></span>',
							                ['action' => 'delete', $enquete->id],
							                ['class' => 'tip', 'escape'   => false, 'title'=>'Supprimer','confirm'  => 'Etes-vous sûr de supprimer l\'enquête ?']);?>
				          </td>
				        </tr>				
				    <?php endforeach; ?>
				    </tbody>
				   </table>
					<div class="paginator">
				        <ul class="pagination">
				            <?= $this->Paginator->prev('< ' . __('Préc.')) ?>
				            <?= $this->Paginator->numbers() ?>
				            <?= $this->Paginator->next(__('Suiv.') . ' >') ?>
				        </ul>
				        <p><?= $this->Paginator->counter() ?></p>
				    </div>
<?php     	if($nbEnquete > 0) { ?>				    
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
				<div id="div_graphique1" ></div><br /><br />
				<div id="div_graphique2" ></div><br /><br />
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
				<div id="div_graphique3" style="width: 100%; height: 400px; "></div>
				<p align='center'>
				<?= $this->Html->link(__('Evolution'), ['controller'=>'Equipes', 'action' => 'visualisationEnqueteEvolution/'.$session->read('Equipe.Identifiant')],['class' => 'btn btn-info'])."&nbsp;&nbsp;" 
				?>
				</p>		
<?php } ?>	    
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>