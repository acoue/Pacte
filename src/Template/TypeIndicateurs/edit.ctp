<div class="blocblanc">
	<h2>Administration</h2>
	<h3>Edition d'un Type d'indicateur</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $typeIndicateur->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>			
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">			
    		<?= $this->Form->create($typeIndicateur, ['id'=>'edit_type_indicateur_form']); ?>
				<div class="row">
					<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"> *</span></label>
                    <div class="col-md-7"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false, 'value' => h($typeIndicateur->name),
															'class' => 'form-control',
                    										'type' => 'text']); ?>
                    </div>
				</div><br /> 
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
		<p align="center">
			<?= $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    		<?= $this->Form->end() ?>
		</p>
		<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>   

		