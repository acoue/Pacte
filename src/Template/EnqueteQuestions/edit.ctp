<div class="blocblanc">
	<h2>Administration - Edition Question de l'enquête de satisfaction </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $enqueteQuestion->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($enqueteQuestion, ['id'=>'edit_enquete_form']); ?>
			<div class="col-md-8">   
				<div class="row">
                	<label class="col-md-4 control-label" for="ordre">Ordre <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('ordre', ['label' => false,'id'=>'ordre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($enqueteQuestion->ordre), 
															'required' =>'required',
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'max2']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false, 
															'required' =>'required', 
                    										'value' => h($enqueteQuestion->name)]); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle">Libellé court  <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 
															'required' =>'required', 
                    										'value' => h($enqueteQuestion->libelle)]); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="aide">Texte d'aide </label>
                    <div class="col-md-8"><?= $this->Form->input('aide', ['label' => false,'id'=>'aide',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80', 
                    										'value' => h($enqueteQuestion->aide)]); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="type">Type de question</label>
                	<div class="col-md-8"><?= $this->Form->input('type', ['label' => false,
                											'options' => ['1' => 'Choix parmis 5 les items', '2' => 'Choix parmis 10 entiers (note)'],
                											'div' => false,'value' => h($enqueteQuestion->type),
															'class' => 'form-control']) ?>    
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