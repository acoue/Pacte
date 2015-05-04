<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Paramètres</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='20%'><?= $this->Paginator->sort('identifiant') ?></th>
				            <th width='50%'><?= $this->Paginator->sort('Libellé') ?></th>
				            <th  width='30%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($parametres as $parametre): ?>
				        <tr>
				            <td><?= $this->Number->format($parametre->id) ?></td>
				            <td><?= h($parametre->name) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $parametre->id], array('escape' => false)); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $parametre->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $parametre->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer {0} ?']);?>
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
			<?= $this->Html->link(__('Créer un paramètre'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>