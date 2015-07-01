<div class="blocblanc">
	<h2>Phase de mise en oeuvre et de suivi</h2>
    <h3>Enquêtes de satisfactyion</h3>    
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 				
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<p>
							<?php 
							foreach ($dateMax as $dm):
							
								$datetime1 = new DateTime($dm->max);
								$datetime2 = new DateTime("now");
								$interval = $datetime1->diff($datetime2);										
								$dateAffiche = strftime('%d/%m/%y', strtotime($dm->max));
								//$diffDate =  date_diff(DateTime($dm->max), date('Y-m-d'));
								if($interval->format('%a') < 365) {
									echo "<p class='alert alert-info'>Date de la dernière enquête pour le service '".$dm->service."' : ".$dateAffiche." - ".$interval->format('%a')." jour(s)</p>";
								} else {
									echo "<p class='alert alert-warning'>Attention : la date de la dernière enquête pour le service '".$dm->service."' : ".$dateAffiche." - ".$interval->format('%a')." jours</p>";
								}
							endforeach;					
							?>
						</p>
					</div>
					<div class="col-md-1"></div>
				</div></br> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='35%'><?= $this->Paginator->sort('Service') ?></th>
				            <th width='35%'><?= $this->Paginator->sort('Fonction') ?></th>
				            <th width='15%'><?= $this->Paginator->sort('Créée le') ?></th>
				            <th  width='15%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($enquetes as $enquete): ?>
				        <tr>
				            <td><?= h($enquete->service) ?></td>
				            <td><?= $enquete->has('fonction') ? $enquete->fonction->name : '' ?></td> 
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
			<?= $this->Html->link(__('Remplir une nouvelle enquête'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>