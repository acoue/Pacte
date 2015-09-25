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
							if ($nbEnquete == 0) echo "<p>Votre équipe n'a répondu à aucune enquête.</p>"; 
							else if ($nbEnquete == 1) echo "<p>Sur la campgane n°".$campagne.", votre équipe a répondu à une enquête.</p>";
							else echo "<p>Sur la campgane n°".$campagne.", votre équipe a répondu à ".$nbEnquete." enquêtes.</p>";
						
						//affichage de la date de l'enquete max
							if($dateMax->count()>0){
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
				</div></br> 
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
			</div>						
			<div class="col-md-1"></div>
		</div>
		<p align="center">
			<?php echo $this->Html->link(__('Remplir une nouvelle enquête'), ['action' => 'add'], ['class'=>'btn btn-default']);
			echo "<br /><br />";
			echo $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-info']); ?>
		
			
			
		</p>
	</div>
</div>