<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Outils</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='10%'><?= $this->Paginator->sort('identifiant') ?></th>
				            <th width='25%'><?= $this->Paginator->sort('Libellé') ?></th>
				            <th width='25%'><?= $this->Paginator->sort('Phase') ?></th>
				            <th width='20%'><?= $this->Paginator->sort('Type') ?></th>
				            <th  width='20%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($outils as $outil): ?>
				        <tr>
				            <td><?= $this->Number->format($outil->id) ?></td>
				            <td><?= h($outil->name) ?></td>
				            <td><?= h($outil->phase->name) ?></td>
				            <td><?php if(h($outil->type) == "cle") echo "Outils clé en main";
				            		 else echo "Outils pédagogiques"; ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $outil->id], array('escape' => false)); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $outil->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $outil->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer l\'outil ?']);?>
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

