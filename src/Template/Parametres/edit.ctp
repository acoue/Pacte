<div class="blocblanc">
	<h2>Administration - Edition Paramètres </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $parametre->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $parametre->id)]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($parametre, ['id'=>'edit_parametre_form']); ?>
			<div class="col-md-8">   
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($parametre->name),
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="description">Description</label>
                    <div class="col-md-8"><?= $this->Form->input('description', ['label' => false,'id'=>'description',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 
                    										'value'=> h($parametre->description),
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="valeur">Valeur <span class="obligatoire"> *</span></label>
                    <div class="col-md-8"><?= $this->Form->input('valeur', ['label' => false,'id'=>'valeur',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'value' => h($parametre->valeur),
                    										'required' =>'required']); ?>
                    </div>                          
				</div>
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
			