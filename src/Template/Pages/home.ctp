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
		        	<td width='10%'><?= $equipe->user->username ?></td>
		            <td width='30%'><?= $equipe->etablissement->libelle ?></td>
		            <td width='30%'><?= $equipe->name ?></td>
		            <td width='10%'><?= $this->Html->link('Etat de la démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$equipe->id],['class' => 'btn btn-default']) ?></td>	
		            <td width='10%'><?= $this->Html->link('Générer un PDF', ['controller'=>'Equipes', 'action' => 'visualisation/1/'.$equipe->id],['class' => 'btn btn-info']) ?></td>	            
		            <td width='10%'><?= $this->Html->link('Enquêtes', ['controller'=>'Equipes', 'action' => 'visualisationEnquete/'.$equipe->id],['class' => 'btn btn-primary']) ?></td>
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
		            <td width='35%'><?= $eqUse->equipe->name ?></td>
		            <td width='10%'><?= $this->Html->link('Etat de la démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$eqUse->equipe->id],['class' => 'btn btn-default']) ?></td>	
		            <td width='10%'><?= $this->Html->link('Générer un PDF', ['controller'=>'Equipes', 'action' => 'visualisation/1/'.$eqUse->equipe->id],['class' => 'btn btn-info']) ?></td>
		            <td width='10%'><?= $this->Html->link('Enquêtes', ['controller'=>'Equipes', 'action' => 'visualisationEnquete/'.$eqUse->equipe->id],['class' => 'btn btn-info']) ?></td>	            	            
		        </tr>		
		    <?php endforeach; ?>
		    </tbody>
	    </table>	    
<?php
		
	} else if($role === 'equipe') {
/**
 * EQUIPE
 */
		echo "<p>".$message."</p><br />";
		
		if($session->read('Equipe.DemarcheEtat') == 0){			
			//Démarche en COURS
			//Bouton suivant la phase
			if($session->read('Equipe.Engagement') == 0 ){
				//Accueil de la phase d'engagement
				echo "<p align='center'>".$this->Html->link('Poursuivre l\'engagement', ['controller'=>'membres', 'action' => 'index/0/1'],['class' => 'btn btn-info'])."</p>";
			}else if($session->read('Equipe.Diagnostic') == 0 ){
				//Accueil de la phase de diagnostic
				echo "<p align='center'>".$this->Html->link('Poursuivre dans la phase de diagnostic', ['controller'=>'projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info'])."</p>";
			} else if($session->read('Equipe.MiseEnOeuvre') == 0 ){
				//Accueil de la phase de mise en oeuvre
?>				
				
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-7"><h5>Vous souhaitez effectuer le suivi de votre plan d'action, cliquez sur le bouton ci-contre : </h5></label>
                    <div class="col-md-4">
                    <?= $this->Html->link('Suivi du plan d\'action', ['controller'=>'PlanActions', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br />  
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-7"><h5>Vous souhaitez réaliser une évaluation à T1, cliquez sur le bouton ci-contre : </h5></label>
                    <div class="col-md-4">
                    <?= $this->Html->link('Evaluation à T1', ['controller'=>'Mesures', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br /> 
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-7"><h5>Vous souhaitez réaliser une enquête de satisfaction, cliquez sur le bouton ci-contre : </h5></label>
                    <div class="col-md-4">
                    <?= $this->Html->link('Enquête de satisfaction', ['controller'=>'Enquetes', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br /><br />				
<?php
				
				$dateSource = substr($datePhase, 6,4)."-".substr($datePhase, 3,2)."-".substr($datePhase, 0,2);
				$datetime1 = new DateTime($dateSource);
				$datetime2 = new DateTime("now");
				$interval = $datetime1->diff($datetime2);
?>
				<div class='row'>
					<div class='col-md-1'></div>
					<div class='col-md-10'>
						<p class='alert alert-info' align='center'>
						Nous avons constaté qu'une durée de 12 mois est appropriée pour terminer cette phase de mise en oeuvre.</br >
						Vous avez commencé la phase de mise en oeuvre le <?= substr($datePhase,0,10) ?>, c'est à dire il y a <?= $interval->format('%m') ?> mois<br /><br />
						Pour clôturer votre phase de mise en oeuvre, cliquez sur le bouton ci-dessous. <br /><br />
						<?= $this->Html->link('Terminer la phase de mise en oeuvre', ['controller'=>'Projets', 'action' => 'terminateMEO'],['class' => 'btn btn-info','confirm' => __('Etes-vous sûr de vouloir terminer la phase de "Mise en Oeuvre" ?')])?>
							
						</p>
					</div>
					<div class='col-md-1'></div>
				</div><br />
<?php 		
			} else if($session->read('Equipe.Evaluation') == 0 ) {
				//Accueil de la phase d'evaluation
?>			
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-7 control-label"><h5>Vous souhaitez effectuer le suivi de votre plan d'action, cliquez sur le bouton ci-contre : </h5></label>
                    <div class="col-md-4">
                    <?= $this->Html->link('Suivi du plan d\'action', ['controller'=>'PlanActions', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br />  
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-7 control-label"><h5>Vous souhaitez réaliser une évaluation à T2, cliquez sur le bouton ci-contre : </h5></label>
                    <div class="col-md-4">
                    <?= $this->Html->link('Evaluation à T2', ['controller'=>'Mesures', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br /> 
				<div class="row">
				 	<div class="col-md-1"></div>
                	<label class="col-md-7 control-label"><h5>Vous souhaitez réaliser une enquête de satisfaction, cliquez sur le bouton ci-contre : </h5></label>
                    <div class="col-md-4">
                    <?= $this->Html->link('Enquête de satisfaction', ['controller'=>'Enquetes', 'action' => 'index'],['class' => 'btn btn-default']) ?>
                    </div>                          
				</div><br /><br />
<?php 
				$dateSource = substr($datePhase, 6,4)."-".substr($datePhase, 3,2)."-".substr($datePhase, 0,2);
				$datetime1 = new DateTime($dateSource);
				$datetime2 = new DateTime("now");
				$interval = $datetime1->diff($datetime2);	
?>				
				<div class='row'>
					<div class='col-md-1'></div>
					<div class='col-md-10'>
						<p class='alert alert-info' align='center'>
						Nous avons constaté qu'une durée de 6 mois est appropriée pour terminer cette phase d'évaluation et ainsi clôturer la démarche Pacte.</br >
						Vous avez commencé la phase d'évaluation le <?= substr($datePhase,0,10) ?>, c'est à dire il y a <?= $interval->format('%m') ?> mois<br /><br />
						Pour clôturer votre phase  d'évaluation et donc votre démarche, cliquez sur le bouton ci-dessous. <br /><br />
						<?= $this->Html->link('Terminer la démarche Pacte',['controller'=>'Demarches', 'action' => 'terminateDemarche'],['class' => 'btn btn-info','confirm' => __('Etes-vous sûr de vouloir terminer votre démarche ?')])?>
							
						</p>
					</div>
					<div class='col-md-1'></div>
				</div><br />
				
<?php 
			}
		} else {
			//Demarche TERMINEE		
			if($interval < 182) {
				echo "<p>Votre démarche est terminée : vous pourrez la consulter jusqu'au ".substr($dateMax,0,10)."</p>";
				echo "<p align='center' >".$this->Html->link('Voir la démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$equipe],['class' => 'btn btn-default'])."</p>";
				
			} else {
				echo "<p class='alert alert-warning'>Votre démarche n'est plus consultable, pour toute question merci de contacter la HAS</p>";
			}
		}
	}
}
?>



