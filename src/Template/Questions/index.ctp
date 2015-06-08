<div class="blocblanc">
	<h2>Administration</h2>
    <h3>Questions</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='10%'><?= $this->Paginator->sort('identifiant') ?></th>
				            <th width='20%'><?= $this->Paginator->sort('Libellé') ?></th>
				            <th width='40%'><?= $this->Paginator->sort('Texte') ?></th>
				            <th width='10%'><?= $this->Paginator->sort('Ordre') ?></th>
				            <th  width='20%' class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($questions as $question): ?>
				        <tr>
				            <td><?= $this->Number->format($question->id) ?></td>
				            <td><?= h($question->name) ?></td>
				            <?php 
				            $msg = h($question->texte);
				            $tab_message = explode(" ", $msg);
				            
				            if(count($tab_message) >= 15) {
								$msg="";
								for($i=0;$i<15;$i++) $msg .= $tab_message[$i]." ";
				            } 
				            ?>
				            <td><?= htmlspecialchars($msg) ?></td>
				            <td><?= $this->Number->format($question->ordre) ?></td>
				            <td class="actions">
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $question->id], array('escape' => false)); ?>&nbsp;&nbsp;
				<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $question->id], array('escape' => false)); ?>&nbsp;&nbsp;     
				<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $question->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer la question ?']);?>
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