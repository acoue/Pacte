<?php 
//debug($this->response->data);die();
$session = $this->request->session();

if($session->check('Engagement.Date')) $date_engagement = $session->read('Engagement.Date');
else  $date_engagement = "";
if($session->check('Engagement.Numero_Demarche')) $numero_demarche = $session->read('Engagement.Numero_Demarche');
else $numero_demarche = "";
if($session->check('Engagement.Libelle_Equipe')) $libelle_equipe = $session->read('Engagement.Libelle_Equipe');
else $libelle_equipe = "";
if($session->check('Engagement.Id_Etablissement')) $id_etablissement = $session->read('Engagement.Id_Etablissement');
else $id_etablissement = "";

?>
<div class="blocblanc">
	<h2>Dossier d'engagement d'une équipe Pacte</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-2"></div>
			<!-- Formulaire de recherche des établissement : Equipe -->
			<?= $this->Form->create('Inscription', ['id'=>'add_inscription_form', 'action' => 'add']) ?>
			<div class="col-md-8"> 
				<div class="row">
                	<label class="col-md-4 control-label" for="date_engagement">Date d'engagement </label>
                    <div class="col-md-8"><?= $this->Form->input('date_engagement', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required',
                    										'value' => $date_engagement,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 	
				<div class="row">			
					<div class="form-group">
						<label class="col-md-4 control-label" >Sélectionner l'établissement</label>
					  	<div class="col-md-8">
					    <?php foreach ($etablissements as $etab): ?>	  	
					  		<div class="radio">
					    		<label for="radios-<?= h($etab->id) ?>">
					      			<input name="etablissement_id" id="etablissement_id" value="<?= h($etab->id) ?>" type="radio" data-location="top" required>
					      			<?= h($etab->finess." - ".$etab->libelle) ?>
					    		</label>
							</div>
						<?php endforeach; ?>
						</div>
					</div>				
				</div><br />	
				<div class="row">
                	<label class="col-md-4 control-label" for="numero_demarche">Numéro de démarche </label>
                    <div class="col-md-8"><?= $this->Form->input('numero_demarche', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required',
                    										'value' => $numero_demarche,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />
		 		<div class="row">
                	<label class="col-md-4 control-label" for="libelle_equipe">Libellé de l'équipe<br /> 
                    <span class="text-muted">Ce libellé n'est que purement informatif</span>                	
                	</label> 
                    <div class="col-md-8"><?= $this->Form->input('libelle_equipe', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Libellé',
                    										'type' => 'text', 
															'required' =>'required',
                    										'data-location' => 'bottom']); ?>
                    </div>
				</div>          
			</div><br />
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Form->button('Poursuivre', ['type' => 'submit','class' => 'btn btn-default']) ?>
		<?= $this->Html->link('Retour', '/Inscriptions/index', ['class' => 'btn btn-info']);?>
	</p>
	<?= $this->Form->end() ?>
	</div>
</div>