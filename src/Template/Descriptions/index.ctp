<div class="blocblanc">
	<h2>Le projet Pacte</h2>
    <h3>Description de l'équipe - Administration</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='35%' ><?= $this->Paginator->sort('fonction') ?></th>
				            <th width='20%' ><?= $this->Paginator->sort('nb_etp','Nombre d\'ETP') ?></th>
				            <th width='35%' ><?= $this->Paginator->sort('service') ?></th>
				            <th width='10%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($descriptions as $description): ?>
				        <tr>
				            <td><?= $description->fonction->name?></td>
				            <td><?= $this->Number->format($description->nb_etp) ?></td>
				            <td><?= h($description->service) ?></td>
				            <td class="actions"><?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $description->id], array('escape' => false)); ?>&nbsp;&nbsp;     
								<?= $this->Form->postLink(
					                '<span><i class="glyphicon glyphicon-trash"></i></span>',
					                ['action' => 'delete', $description->id],
					                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer cette fonction?']);?>
				          </td>
				        </tr>
				
				    <?php endforeach; ?>
				    </tbody>
				   </table>					
			</div>						
			<div class="col-md-1"></div>
		</div>
		<p align="center">
			<?= $this->Html->link(__('Ajouter une fonction'), ['action' => 'add/'.$id_projet], ['class'=>'btn btn-default']) ?>
			<br /><br />
			<?= $this->Html->link(__('Retour'), ['controller'=>'projets', 'action' => 'index'], ['class'=>'btn btn-info']) ?>
		</p>
	</div>
</div>

