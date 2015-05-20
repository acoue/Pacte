<div class="blocblanc">
	<h2>Administration</h2>
	<h3>Ajout d'un Type d'indicateur</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($typeIndicateur, ['id'=>'add_type_indicateur_form']); ?>
			<div class="col-md-8">
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('name', ['label' => false,
                											'div' => false,
															'class' => 'form-control', 
                    										'required' =>'required']) ?>    
                	</div>                 
				</div>
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
	<p align="center">
		<?= $this->Form->button('Ajouter', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>   

