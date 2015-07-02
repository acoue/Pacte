<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Evaluation à T0</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-9"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='5%'></th>
				            <th width='15%'>Outils</th>
				            <th width='40%'>Evolutions des résultats intermédiares<br />Points forts et axes d'amélioration identifiés</th>
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
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $mesure->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $mesure->id],
				                ['class' => 'tip','title'=>'Supprimer', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer ?']);?>
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
			echo "&nbsp;&nbsp;";
			echo $this->Html->link(__('Suite'),['controller'=>'mesures', 'action'=>'validate'],['class'=>'btn btn-default']);
			
		}
			?>
		</p>
	</div>
</div>

