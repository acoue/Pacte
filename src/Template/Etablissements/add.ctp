<div class="blocblanc">
	<h2>Administration - Ajout Etablissement </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
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
															'required' =>'required']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="finess">FINESS <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('finess', ['label' => false,'id'=>'finess',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'maxlength'=>'9',
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min9',
															'required' =>'required']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="numero_demarche">Numéro de démarche <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('numero_demarche', ['label' => false,'id'=>'numero_demarche',
														   	'div' => false,'type' => 'text',
															'class' => 'form-control', 
															'required' =>'required']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="niveau_certification">Rôle <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('niveau_certification', ['label' => false,
                											'options' => ['Certification' => 'Certification', 
                														  	'Certification avec recommandations' => 'Certification avec recommandations', 
                														  	'Certification sans recommandations' => 'Certification sans recommandations', 
                														  	'Non Certification' => 'Non Certification'],
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