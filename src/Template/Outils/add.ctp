<div class="blocblanc">
	<h2>Administration - Ajout Outil</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($outil, ['id'=>'add_outil_form','enctype' => 'multipart/form-data']); ?>
			<div class="col-md-8">
				<div class="row">
					<label class="col-md-4 control-label" for="fichier">Fichier <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('fichier', ['label' => false,'id'=>'fichier',
														   	'div' => false,
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'file']); ?>
                    </div>
				</div><br /> 			    
				<div class="row">
                	<label class="col-md-4 control-label" for="texte">Description <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('texte', ['label' => false,'id'=>'texte',
														   	'div' => false,
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
		<?= $this->Form->button('Ajouter', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>     
