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
				            <th width='20%'><?= $this->Paginator->sort('Libellé') ?></th>
				            <th width='40%'><?= $this->Paginator->sort('description') ?></th>
				            <th width='25%'><?= $this->Paginator->sort('valeur') ?></th>
				            <th  width='15%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($parametres as $parametre): ?>
				        <tr>
				            <td><?= h($parametre->name) ?></td>
				            <td><?= h($parametre->description) ?></td>
				            <td><?= $this->Text->excerpt(h($parametre->valeur),'method',200) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $parametre->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $parametre->id],
				                ['class' => 'tip', 'title'=>'Supprimer','escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer {0} ?']);?>
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