<?php 
$session = $this->request->session();

if($session->check('Engagement.Date')) $date_engagement = $session->read('Engagement.Date');
else  $date_engagement = "";
if($session->check('Engagement.Numero_Demarche')) $numero_demarche = $session->read('Engagement.Numero_Demarche');
else $numero_demarche = "";
?>

<div class="blocblanc">
	<h2>Dossier d'engagement d'une équipe Pacte</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-2"></div>
<!-- Formulaire de recherche des établissement : Equipe -->
<?= $this->Form->create('Inscription', ['id'=>'inscription_form']) ?>
			<div class="col-md-8">
		 		<div class="row">
                	<label class="col-md-5 control-label" for="date_engagement">Date d'engagement <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-5"><?= $this->Form->input('date_engagement', ['id'=>'date_engagement',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Date d\'engagement', 
															'required' =>'required',
                    										'value' => $date_engagement,
                    										'data-location' => 'bottom',
                    										'data-validation'=>'date',
                    										'data-validation-format' => 'dd/mm/yyyy']); ?>
                    </div>                          
				</div><br /> 
		 		<div class="row">
                	<label class="col-md-5 control-label" for="numero_demarche">Numéro de démarche <span class="obligatoire"><sup> *</sup></span><br /> 
                    <span class="text-muted">4 Chiffres mentionnés sur les courriers de la HAS</span>                	
                	</label> 
                    <div class="col-md-5"><?= $this->Form->input('numero_demarche', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'N° démarche',
                    										'type' => 'text', 
															'required' =>'required', 'maxlength'=>'4',
                    										'value' => $numero_demarche,
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min4']); ?>
                    </div>
				</div>                            
			</div>
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Form->button('Poursuivre', ['type' => 'submit','class' => 'btn btn-default']) ?>
		<?= $this->Form->end() ?>
    </p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>