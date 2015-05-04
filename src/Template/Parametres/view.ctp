<div class="blocblanc">
	<h2>Administration - Paramètres </h2>
    <h3><?= h($parametre->name) ?></h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit', $parametre->id],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $parametre->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $parametre->id)]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">  
				<div class="row">
                	<label class="col-md-4 control-label" for="id">Identifiant </label>
                    <div class="col-md-8"><?= $this->Form->input('id', ['label' => false,'id'=>'id',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($parametre->id),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé </label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($parametre->name),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="valeur">Valeur </label>
                    <div class="col-md-8"><?= $this->Form->input('valeur', ['label' => false,'id'=>'valeur',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'value' => h($parametre->valeur),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />
			</div>						
			<div class="col-md-1"></div>
		</div>
	</div>
</div>