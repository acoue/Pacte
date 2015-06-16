<?php
//debug($equipesUsers);die();
?>
<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Répartition Expert - Users</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='25%' >Utilisateur</th>
				            <th width='30%'>Etablissement</th>
				            <th width='30%'>Equipe</th>
				            <th width='15%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($equipesUsers as $equipesUser): ?>
				        <tr>
				            <td><?= h($equipesUser->user->prenom)." ".h($equipesUser->user->nom) ?></td>
				            <td><?= h($equipesUser->equipe->etablissement->libelle) ?></td>
				            <td><?= h($equipesUser->equipe->name) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $equipesUser->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $equipesUser->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer la relation ?']);?>
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
			<?= $this->Html->link(__('Ajouter une relation'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>