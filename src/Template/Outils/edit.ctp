<div class="blocblanc">
	<h2>Administration</h2>
	<h3>Edition d'outil</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $outil->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $outil->id)]) ?><br /><br/>			
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">			
    		<?= $this->Form->create($outil, ['id'=>'edit_outil_form']); ?>
				<div class="row">
					<label class="col-md-4 control-label" for="name">Fichier</label>
                    <div class="col-md-7"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false, 'value' => h($outil->name),
															'class' => 'form-control',
                    										'type' => 'text', 'disabled' =>'disabled']); ?>
                    </div> 
                    <div class="col-md-1">
                    <?= $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/'.h($outil->name), ['class' => 'titre','target' => '_blank','escape' => false]);?>
                    </div> 
				</div><br /> 	
				<div class="row">
					<label class="col-md-4 control-label" for="libelle">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false, 'value' => h($outil->libelle),
															'class' => 'form-control',
                    										'type' => 'text', 'required' =>'required']); ?>
                    </div>                     
				</div><br /> 			    
				<div class="row">
                	<label class="col-md-4 control-label" for="texte">Description <span class="obligatoire"> *</span></label>
                    <div class="col-md-8"><?= $this->Form->input('texte', ['label' => false,
														   	'div' => false, 'value' => h($outil->texte),
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'textarea', 'escape' => false,
															'rows' => '5', 'cols' => '80']); ?>
                    </div>                        
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="phase_id">Phase <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('phase_id', ['label' => false,'id'=>'phase_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										['options' => $phases], 
                    										'value'=> $outil->phase,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="ordre">Ordre <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('ordre', ['label' => false,'id'=>'ordre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'value'=> $outil->ordre,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />    
				<div class="row">
                	<label class="col-md-4 control-label" for="type">Type <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('type', ['label' => false,
                											'options' => ['' => 'Sélectionner', 'pedagogiques' => 'Outils pédagogiques', 'cle' => 'Outils clé en main'],
                											'div' => false,
															'class' => 'form-control', 
                    										'required' =>'required']) ?>    
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
