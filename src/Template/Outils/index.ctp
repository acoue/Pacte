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
				            <th width='50%'><?= $this->Paginator->sort('Phase') ?></th>
				            <th  width='30%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($outils as $outil): ?>
				        <tr>
				            <td><?= $this->Number->format($outil->id) ?></td>
				            <td><?= h($outil->name) ?></td>
				            <td><?= h($outil->phase->name) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $outil->id], array('escape' => false)); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $outil->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $outil->id],
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
			<?= $this->Html->link(__('Créer un outil'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>



<div class="outils index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('phase_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($outils as $outil): ?>
        <tr>
            <td><?= $this->Number->format($outil->id) ?></td>
            <td><?= h($outil->name) ?></td>
            <td>
                <?= $outil->has('phase') ? $this->Html->link($outil->phase->name, ['controller' => 'Phases', 'action' => 'view', $outil->phase->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $outil->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $outil->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $outil->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outil->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
