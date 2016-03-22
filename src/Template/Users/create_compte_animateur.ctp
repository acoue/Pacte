<div class="blocblanc">
	<h2>Création d'un compte animateur CRM</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
		 		<div class="row">
                	<label class="col-md-5 control-label" for="nom">Nom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('nom', ['id'=>'nom',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Nom', 
															'required' =>'required',
                    										'value' => '']); ?>
                    </div>                          
				</div><br />
		 		<div class="row">
                	<label class="col-md-5 control-label" for="prenom">Prénom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('prenom', ['id'=>'prenom',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Prénom', 
															'required' =>'required',
                    										'value' => '']); ?>
                    </div>                          
				</div><br />  
		 		<div class="row">
                	<label class="col-md-5 control-label" for="email">Email <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('email', ['id'=>'email',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'E-Mail', 
															'required' =>'required',
                    										'value' => '',
                    										'data-validation'=>'email']); ?>
                    </div>                          
				</div><br />
		 		<div class="row">
                	<label class="col-md-5 control-label" for="fonction">Fonction <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('fonction', ['id'=>'fonction',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Fonction', 
															'required' =>'required',
                    										'value' => '']); ?>
                    </div>                          
				</div><br />     
		 		<div class="row">
                	<label class="col-md-5 control-label" for="lieux">Lieux / Etablissement <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('lieux', ['id'=>'lieux',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Fonction', 
															'required' =>'required',
                    										'value' => '']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-5 control-label" for="cadre">Cadre d'utilisation des outils CRM <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('cadre', ['label' => false,'id'=>'cadre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options' => ['' => 'Sélectionner'],
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />                                 
			</div>
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Form->button('Poursuivre', ['type' => 'submit','class' => 'btn btn-default']) ?>

    </p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>