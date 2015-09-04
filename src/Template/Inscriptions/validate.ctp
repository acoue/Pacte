<div class="blocblanc">
	<h2>Fiche d'engagement de la direction - Etape n°1</h2>
    <h3>Validation de l'engagement</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<?= $this->Form->create('Inscription', ['id'=>'validate_inscription_form', 'action' => 'validate']) ?>
			<div class="col-md-10"> <?php 
if(strlen($MessageSituationcrise) > 1 )  { ?>		
				<div  class="row">
					<?= $MessageSituationcrise ?>
				</div><br />
<?php }
if(strlen($MessageRestructuration) > 1 )  { ?>	
				<div  class="row">
					<?= $MessageRestructuration ?>
				</div><br />
<?php } ?>
				<div  class="row">
					<?= $messageTitreValidation->valeur ?>
				</div><br />
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-3 control-label" for="score">Noter le score obtenu </label>
					<div class="col-md-2">
						<?= $this->Form->input('score', ['label' => false,'id'=>'score',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $score,
                    										'disabled' => 'disabled']); ?>
                    </div>	
                    <label class="col-md-3 control-label" for="nbOui">Nombre de 'Oui' que vous enregistrez </label>	
					<div class="col-md-2">
						<?= $this->Form->input('nbOui', ['label' => false,'id'=>'nbOui',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $nbOui."/10",
                    										'disabled' => 'disabled']); ?>
                    </div>	                    
					<div class="col-md-1"></div>
				</div><br /><br />
				<div  class="row">
					<div class="alert alert-info">
 						<p align="justify"><?= $messageScore ?>
						</p>
					</div> 
				</div><br />
				<div  class="row">
					<div class="alert alert-info">
						<p align="center"><span class="label label-warning">Avertissement</span></p>
 						<p align="justify"><?= $messageAvertissement->valeur ?>
						</p>
					</div> 
				</div>
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-4 control-label" for="mail">Email de contact <span class="obligatoire"><sup> *</sup></span></label>
					<div class="col-md-6">
						<?= $this->Form->input('mail', ['label' => false,'id'=>'mail',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text',
                    										'data-location' => 'bottom',
                    										'data-validation'=>'email',
															'required' =>'required']); ?>
                    </div>		
					<div class="col-md-1"></div>
				</div>
			</div><br />						
			<div class="col-md-1"></div>
		</div><br />
	<p align="center">
		<?= $this->Form->button('Vous souhaitez poursuivre', ['type' => 'submit','class' => 'btn btn-info']) ?><br /><br />
		<?= $this->Form->end() ?>
		<?= $this->Html->link('Vous ne souhaitez pas poursuivre', '/Inscriptions/validate/0', ['class' => 'btn btn-danger']);?><br /><br />
		<?= $this->Html->link('Retour', '/Inscriptions/create', ['class' => 'btn btn-default']);?>
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>
