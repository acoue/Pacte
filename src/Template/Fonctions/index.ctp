<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Fonctions</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='10%'><?= $this->Paginator->sort('id') ?></th>
				            <th width='70%'><?= $this->Paginator->sort('name') ?></th>
				            <th  width='20%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody> 
				    <?php foreach ($fonctions as $fonction): ?>
				        <tr>
				            <td><?= $this->Number->format($fonction->id) ?></td>
				            <td><?= h($fonction->name) ?></td>				           
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $fonction->id], ['title'=>'Visualiser','escape' => false]); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $fonction->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $fonction->id],
				                ['class' => 'tip', 'escape'   => false, 'title'=>'Supprimer la question','confirm'  => 'Etes-vous sûr de supprimer {0} ?']);?>
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
			<?= $this->Html->link(__('Créer une question'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>

