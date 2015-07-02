<div class="blocblanc">
	<h2>Administration - Ajout Paramètres </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($parametre, ['id'=>'add_parametre_form']); ?>
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-3 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-9"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-3 control-label" for="description">Description</label>
                    <div class="col-md-9"><?= $this->Form->input('description', ['label' => false,'id'=>'description',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-3 control-label" for="valeur">Valeur <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-9">
                    <?= $this->Form->input('valeur', ['label' => false,'id'=>'valeur',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'required' =>'required']); ?>
                    <?= $this->CKEditor->replace('valeur') ?>
                    </div>                          
				</div><br />
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