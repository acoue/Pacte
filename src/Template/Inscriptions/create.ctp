<?php 
$session = $this->request->session();

if($session->check('Engagement.Libelle_Equipe')) $libelle_equipe = $session->read('Engagement.Libelle_Equipe');
else $libelle_equipe = "";
if($session->check('Engagement.Id_Etablissement')) $id_etablissement = $session->read('Engagement.Id_Etablissement');
else $id_etablissement = "";
if($session->check('Engagement.Date')) $date_engagement = $session->read('Engagement.Date');
else $date_engagement = "";
if($session->check('Engagement.Numero_Demarche')) $numero_demarche = $session->read('Engagement.Numero_Demarche');
else $numero_demarche = "";
if($session->check('Engagement.Finess')) $finess = $session->read('Engagement.Finess');
else $finess = "";
if($session->check('Engagement.Raison_Sociale')) $raison_sociale = $session->read('Engagement.Raison_Sociale');
else $raison_sociale = "";
if($session->check('Engagement.Resultat_Formulaire')) $formulaire = $session->read('Engagement.Resultat_Formulaire');
else $formulaire = null;
?>
<div class="blocblanc">
	<h2>Fiche d'engagement de la direction - Etape n°1</h2>
    <h3>Votre établissement est-il prêt pour Pacte ?</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<!-- Formulaire de recherche des établissement : Equipe -->
			<?= $this->Form->create('Inscription', ['id'=>'create_form', 'action' => 'create']) ?>
			<div class="col-md-10"> 
				<div class="row">
                	<label class="col-md-4 control-label" for="date_engagement">Date d'engagement </label>
                    <div class="col-md-8"><?= $this->Form->input('date_engagement', ['label' => false,'id'=>'date_engagement',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $date_engagement,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="numero_demarche">Numéro de démarche </label>
                    <div class="col-md-8"><?= $this->Form->input('numero_demarche', ['label' => false,'id'=>'numero_demarche',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $numero_demarche,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 
				<?= $this->Form->hidden('etablissement_id',['value'=>$id_etablissement]);?>
				<div class="row">
                	<label class="col-md-4 control-label" for="finess">Finess </label>
                    <div class="col-md-8"><?= $this->Form->input('finess', ['label' => false,'id'=>'finess',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $finess,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="raison_sociale">Raison sociale </label>
                    <div class="col-md-8"><?= $this->Form->input('raison_sociale', ['label' => false,'id'=>'raison_sociale',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $raison_sociale,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle_equipe">Libellé équipe </label>
                    <div class="col-md-8"><?= $this->Form->input('libelle_equipe', ['label' => false,'id'=>'libelle_equipe',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $libelle_equipe,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />
                <p><?=  $messageTitreQuestionnaire->valeur ?></p>

				<div class="row">
                	<label class="col-md-4 control-label" for="niveau">Niveau de certification </label>
                    <div class="col-md-8"><?= $this->Form->input('niveau', ['label' => false,'id'=>'niveau',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $etablissement->niveau_certification,
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />
    <?php foreach ($questions as $question): ?>				
				<div class="row">
					<label class="col-md-7 control-label" for="q_<?= $question->id ?>" ><?= $question->texte ?></label>
	                <div class="col-md-2">
		                <?php 		                
		                if($formulaire['q_'.$question->id] === 'O') {?>
		                <div class="radio">		                
		                	<label for="q_<?= $question->id ?>-1">
		                	<input name="q_<?= $question->id ?>" id="q_<?= $question->id ?>-1" value="O" type="radio" required="required" checked> Oui
		                	</label>
		                </div>
						<div class="radio">
							<label for="q_<?= $question->id ?>-2">
						    	<input name="q_<?= $question->id ?>" id="questions_<?= $question->id ?>-2" value="N" type="radio">Non
							</label>
						</div>			                	
		                <?php } else if($formulaire['q_'.$question->id] === 'N') { ?>
		                <div class="radio">		                
		                	<label for="q_<?= $question->id ?>-1">
		                	<input name="q_<?= $question->id ?>" id="q_<?= $question->id ?>-1" value="O" type="radio" required="required"> Oui
		                	</label>
		                </div>
						<div class="radio">
							<label for="q_<?= $question->id ?>-2">
						    	<input name="q_<?= $question->id ?>" id="questions_<?= $question->id ?>-2" value="N" type="radio" checked>Non
							</label>
						</div>
		                <?php } else { ?>
		                <div class="radio">		                
		                	<label for="q_<?= $question->id ?>-1">
		                	<input name="q_<?= $question->id ?>" id="q_<?= $question->id ?>-1" value="O" type="radio" required="required"> Oui
		                	</label>
		                </div>
						<div class="radio">
							<label for="q_<?= $question->id ?>-2">
						    	<input name="q_<?= $question->id ?>" id="questions_<?= $question->id ?>-2" value="N" type="radio">Non
							</label>
						</div>
		                <?php }?>
		                
		                   
	                 </div>   
	                 <div class="col-md-3 BoutonAide">
	                 	<a class="btn btn-xs btn-info" data-toggle="popover" title="Aide"
	                 		data-content="<?= $question->texte_aide ?>"
	                        role="button">Aide</a>
	                 </div>                         
                 </div>  <br />
    <?php endforeach; ?>

    
    
			</div><br />						
		  <div class="col-md-1"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Html->link('Retour', '/Inscriptions/index', ['class' => 'btn btn-info']);?>
		<?= $this->Form->button('Poursuivre', ['type' => 'submit','class' => 'btn btn-default']) ?>
	</p>
	<?= $this->Form->end() ?>
	</div>
</div>