<div class="blocblanc">
	<h2>Administration - Ajout Etablissement </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit', $etablissement->id],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $etablissement->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer l\'établissement ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($etablissement, ['id'=>'add_etablissement_form']); ?>
			<div class="col-md-8">   
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($etablissement->libelle),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="finess">FINESS <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('finess', ['label' => false,'id'=>'finess',
														   	'div' => false,
															'class' => 'form-control', 
                    										'value' => h($etablissement->finess), 
                    										'type' => 'text',
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="numero_demarche">Numéro de démarche <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('numero_demarche', ['label' => false,'id'=>'numero_demarche',
														   	'div' => false,'type' => 'text',
															'class' => 'form-control', 
                    										'value' => h($etablissement->numero_demarche),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="niveau_certification">Rôle <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('niveau_certification', ['label' => false,                											
                											'div' => false,
                    										'value' => h($etablissement->niveau_certification), 
															'class' => 'form-control',
                    										'disabled' => 'disabled']) ?>    
                	</div>                 
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div><br /><br />
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>