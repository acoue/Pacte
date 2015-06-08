<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Utilisateur</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='20%'><?= $this->Paginator->sort('identifiant') ?></th>
				            <th width='30%'><?= $this->Paginator->sort('Login') ?></th>
				            <th width='20%'><?= $this->Paginator->sort('Rôle') ?></th>
				            <th  width='30%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($users as $user): ?>
				        <tr>
				            <td><?= $this->Number->format($user->id) ?></td>
				            <td><?= h($user->username) ?></td>
				            <td><?= h($user->role) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $user->id], array('escape' => false)); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $user->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $user->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer ?']);?>
				  
				<?php if($user->active == 1) echo $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-minus-sign"></i></span>',
				                ['action' => 'desactiveUser', $user->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de desactiver l\'utilisateur ?']);
					else echo $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-plus-sign"></i></span>',
				                ['action' => 'activeUser', $user->id],
				                ['class' => 'tip', 'escape'   => false]);
				
				?>
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-retweet"></i></span>', ['action' => 'regeneratePassword', $user->id], array('escape' => false)); ?>
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
			<?= $this->Html->link(__('Créer un Utilisateur'), ['action' => 'add'], ['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>