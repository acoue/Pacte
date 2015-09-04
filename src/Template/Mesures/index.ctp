<div class="blocblanc">

<?php 
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
	<h2>Phase de diagnostic</h2>
    <h3>Evaluation à T0</h3>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
	<h2>Phase de mise en oeuvre et de suivi</h2>
    <h3>Evaluation à T1</h3>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
	<h2>Phase d'évaluation</h2>
    <h3>Evaluation à T2</h3>
<?php } ?>
	<div class="blocblancContent"> 
		<div class="row"> 
			<div class="col-md-1"></div>
			<div class="col-md-11">
			<?= $message->valeur ?>
			</div>
		</div><br />
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-9">
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='5%'></th>
				            <th width='15%'>Outils</th>
				            <th width='40%'>Evolutions des résultats<br />Points forts et axes d'amélioration identifiés</th>
				            <th width='25%'>Vos documents</th>
				            <th  width='15%'  class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($mesures as $mesure): ?>
				        <tr>
				            <td>				            
							<?php 
							if(h($mesure->resultat) && h($mesure->file)) {
								echo $this->Html->image('cocheOk.jpg');
							} else {
								echo $this->Html->image('cocheKo.jpg');						
							}
							?>				            
				            </td>
				            <td><?= h($mesure->name) ?></td>
				            <td><?= h($mesure->resultat) ?></td>
				            <td><?= h($mesure->file) ?></td>
				            <td class="actions">
				<?php 
					if(h($mesure->file)) echo $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/userDocument/'.$session->read('Auth.User.username').'/'.h($mesure->file), ['class' => 'titre','target' => '_blank','escape' => false]);
				?>
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $mesure->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
			
				<?php if($mesure->name != 'Matrice de Maturité à T0' ) { 
						echo $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $mesure->id],
				                ['class' => 'tip','title'=>'Supprimer', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer ?']);
						} ?>
				          </td>
				        </tr>
				
				    <?php endforeach; ?>
				    </tbody>
				</table>					
			</div>						
			<div class="col-md-1">
			<?= $this->Html->link(__('Ajouter'),['action'=>'add'],['class'=>'btn btn-info']);?>
			</div>
			<div class="col-md-1"></div>
		</div>
		<p align="center">
<?php
		$session = $this->request->session();
		if($session->read('Equipe.Diagnostic') == '0') {
			
			echo $this->Html->link(__('Retour'),['controller'=>'PlanActions', 'action'=>'index'],['class'=>'btn btn-info']);
			
			// control de la date
			$dateSource = substr($datePhase, 6,4)."-".substr($datePhase, 3,2)."-".substr($datePhase, 0,2);
			$datetime1 = new DateTime($dateSource);
			$datetime2 = new DateTime("now");
			$interval = $datetime1->diff($datetime2);
?>
			
				<div class='row'>
					<div class='col-md-2'></div>
					<div class='col-md-8'>
						<p class='alert alert-info' align='center'>
						Nous avons constaté que durée de 6 mois est appropriée pour terminer cette phase de diagnostic.</br >
						Vous avez commencé la phase de diagnostic le <?= substr($datePhase,0,10) ?>, c'est à dire il y a <?= $interval->format('%m') ?> mois<br /><br />
						Pour clôturer votre phase de diiagnostic, cliquez sur le bouton ci-dessous. <br /><br />
						<?= $this->Html->link(__('Suite'),['controller'=>'mesures', 'action'=>'validate'],['class'=>'btn btn-default'])?>
							
						</p>
					</div>
					<div class='col-md-2'></div>
				</div>
<?php 
		} else {
			echo $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-info']);
		}
?>
		</p>
	</div>
</div>

