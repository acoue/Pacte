<div class="blocblanc">
	<h2>Administration - Envoi d'un email</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-2"></div>					  
			<div class="col-md-8"> 	
    		<?= $this->Form->create('emailAdmin', ['id'=>'contact_form']); ?>			
		 		<div class="row">
                	<label class="col-md-5 control-label" for="sujet">Sujet <span class="obligatoire"><sup> *</sup></span></label> 
                    <div class="col-md-7"><?= $this->Form->input('sujet', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Sujet de l\'email',
                    										'type' => 'text', 'value' => '',
															'required' =>'required']); ?>
                    </div>
				</div><br /> 				
		 		<div class="row">
                	<label class="col-md-5 control-label" for="destinataire">Email destinataire(s) - Séparés par des ";" <span class="obligatoire"><sup> *</sup></span></label> 
                    <div class="col-md-7"><?= $this->Form->input('destinataire', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Destinataire(s) de l\'email',
                    										'type' => 'text', 'value' => '',
															'required' =>'required']); ?>
                    </div>
				</div><br />
		 		<div class="row">
                	<label class="col-md-5 control-label" for="body">Message <span class="obligatoire"><sup> *</sup></span></label> 
                    <div class="col-md-7"><?= $this->Form->textarea('body', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'value' => '',
															'required' =>'required']); ?>
                    </div>
				</div>              
			</div>
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Form->button('Envoyer', ['type' => 'submit','class' => 'btn btn-default']) ?>
    </p>
<?= $this->Form->end() ?>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>
