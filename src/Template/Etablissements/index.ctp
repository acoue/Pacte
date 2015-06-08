<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Etablissement</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th><?= $this->Paginator->sort('libelle') ?></th>
				            <th><?= $this->Paginator->sort('finess') ?></th>
				            <th><?= $this->Paginator->sort('numero_demarche') ?></th>
				            <th><?= $this->Paginator->sort('niveau_certif') ?></th>
				            <th class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
				   <?php foreach ($etablissements as $etablissement): ?>
				        <tr>
				            <td><?= h($etablissement->libelle) ?></td>
				            <td><?= h($etablissement->finess) ?></td>
				            <td><?= h($etablissement->numero_demarche) ?></td>
				            <td><?= h($etablissement->niveau_certification) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $etablissement->id], array('escape' => false)); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $etablissement->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $etablissement->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer l\'établissement?']);?>
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
			<?= $this->Html->link(__('Ajouter un établissement'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>

