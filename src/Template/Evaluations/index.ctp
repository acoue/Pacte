<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Fonctionnement d'équipe</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-9"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='15%'>Outils</th>
				            <th width='40%'>Votre Synthèse</th>
				            <th width='30%'>Vos documents</th>
				            <th  width='15%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($evaluations as $evaluation): ?>
				        <tr>
				            <td><?= h($evaluation->name) ?></td>
				            <td><?= h($evaluation->synthese) ?></td>
				            <td><?= h($evaluation->file) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $evaluation->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $evaluation->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer ?']);?>
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
			echo $this->Html->link(__('Suite'),['controller'=>'PlanActions', 'action'=>'index'],['class'=>'btn btn-default']);
			echo "&nbsp;&nbsp;";
			echo $this->Html->link(__('Retour'),['controller'=>'projets', 'action'=>'diagnostic_index'],['class'=>'btn btn-info']);
		}
			?>
		</p>
	</div>
</div>

