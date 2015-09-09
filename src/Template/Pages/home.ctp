<?php
use Cake\I18n\Time;
$session = $this->request->session();

//Utilisateur connecté
if($session->check('Auth.User.role')) {
	$role = $session->read('Auth.User.role');

/**
 * ADMINITRATEUR
 */
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
/**
 * CHEF DE PROJET HAS
 */
		echo "<p>".$message->valeur."</p>";
	} else if($role === 'expert') { 
/**
 * EXPERT
 */	
?>
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
/**
 * EQUIPE
 */
		echo "<p>".$message."</p>";
		
		if($session->read('Equipe.DemarcheEtat') == 0){			
			//Démarche en COURS
			//Bouton suivant la phase
			if($session->read('Equipe.Engagement') == 0 ){
				//Accueil de la phase d'engagement
				echo $this->Html->link('Poursuivre l\'engagement', ['controller'=>'membres', 'action' => 'index/0/1'],['class' => 'btn btn-info']);
			}else if($session->read('Equipe.Diagnostic') == 0 ){
				//Accueil de la phase de diagnostic
				echo $this->Html->link('Poursuivre dans la phase de diagnostic', ['controller'=>'projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info']);
			} else if($session->read('Equipe.MiseEnOeuvre') == 0 ){
				//Accueil de la phase de mise en oeuvre
?>				
				
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-5 control-label">Vous souhaitez effectuer le suivi de votre plan d'action, cliquez sur le boutopn ci-contre : </label>
                    <div class="col-md-6">
                    <?= $this->Html->link('Suivi du plan d\'action', ['controller'=>'PlanActions', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br />  
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-5 control-label">Evaluation à T1 ..... </label>
                    <div class="col-md-6">
                    <?= $this->Html->link('Evaluation à T1', ['controller'=>'Mesures', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br /> 
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-5 control-label">Enquête de satisfaction ..... </label>
                    <div class="col-md-6">
                    <?= $this->Html->link('Enquête de satisfaction', ['controller'=>'Enquetes', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br />				
<?php
				
				$dateSource = substr($datePhase, 6,4)."-".substr($datePhase, 3,2)."-".substr($datePhase, 0,2);
				$datetime1 = new DateTime($dateSource);
				$datetime2 = new DateTime("now");
				$interval = $datetime1->diff($datetime2);
?>
				<div class='row'>
					<div class='col-md-1'></div>
					<div class='col-md-9'>
						<p class='alert alert-info' align='center'>
						Nous avons constaté qu'une durée de 12 mois est appropriée pour terminer cette phase de Mise en oeuvre.</br >
						Vous avez commencé la phase de mise en oeuvre le <?= substr($datePhase,0,10) ?>, c'est à dire il y a <?= $interval->format('%m') ?> mois<br /><br />
						Pour clôturer votre phase de mise en oeuvre, cliquez sur le bouton ci-dessous. <br /><br />
						<?= $this->Html->link('Terminer la phase de mise en oeuvre', ['controller'=>'Projets', 'action' => 'terminateMEO'],['class' => 'btn btn-info','confirm' => __('Etes-vous sûr de vouloir terminer la phase de "Mise en Oeuvre" ?')])?>
							
						</p>
					</div>
					<div class='col-md-2'></div>
				</div>
<?php 		
			} else if($session->read('Equipe.Evaluation') == 0 ) {
				//Accueil de la phase d'evaluation
?>			
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-5 control-label">Vous souhaitez effectuer le suivi de votre plan d'action, cliquez sur le boutopn ci-contre : </label>
                    <div class="col-md-6">
                    <?= $this->Html->link('Suivi du plan d\'action', ['controller'=>'PlanActions', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br />  
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-5 control-label">Evaluation à T2 ..... </label>
                    <div class="col-md-6">
                    <?= $this->Html->link('Evaluation à T2', ['controller'=>'Mesures', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br /> 
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-5 control-label">Enquête de satisfaction ..... </label>
                    <div class="col-md-6">
                    <?= $this->Html->link('Enquête de satisfaction', ['controller'=>'Enquetes', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br />
<?php 
				$dateSource = substr($datePhase, 6,4)."-".substr($datePhase, 3,2)."-".substr($datePhase, 0,2);
				$datetime1 = new DateTime($dateSource);
				$datetime2 = new DateTime("now");
				$interval = $datetime1->diff($datetime2);	
?>				
				<div class='row'>
					<div class='col-md-1'></div>
					<div class='col-md-9'>
						<p class='alert alert-info' align='center'>
						Nous avons constaté qu'une durée de 6 mois est appropriée pour terminer cette phase d'évaluation et ainsi clôturer la démarche Pacte.</br >
						Vous avez commencé la phase d'évaluation le <?= substr($datePhase,0,10) ?>, c'est à dire il y a <?= $interval->format('%m') ?> mois<br /><br />
						Pour clôturer votre phase  d'évaluation et donc votre démarche, cliquez sur le bouton ci-dessous. <br /><br />
						<?= $this->Html->link('Terminer la démarche Pacte',['controller'=>'Demarches', 'action' => 'terminateDemarche'],['class' => 'btn btn-info','confirm' => __('Etes-vous sûr de vouloir terminer votre démarche ?')])?>
							
						</p>
					</div>
					<div class='col-md-2'></div>
				</div>
				
<?php 
			}
		} else {
			//Demarche TERMINEE		
			if($interval < 182) {
				echo "<p>Votre démarche est terminée : vous pourrez la consulter jusqu'au ".substr($dateMax,0,10)."</p>";
				echo $this->Html->link('Voir la démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$equipe],['class' => 'btn btn-default']);
				
			} else {
				echo "<p class='alert alert-warning'>Votre démarche n'est plus consultable, pour toute question merci de contacter la HAS</p>";
			}
			
			
			
			
			
			
			
			
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



