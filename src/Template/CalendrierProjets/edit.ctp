<!-- src/Template/CalendrierProjets/edit.ctp -->
<div class="blocblanc">
	<h2>Administration - Edition d'une étape dans le calendrier</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			 <?php 
			 	$session = $this->request->session();
			 	echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $calendrierProjet->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]);
			 	echo "<br /><br/>";
			 	if($session->read('Equipe.Diagnostic') == '0') echo $this->Html->link(__('Retour'), ['controller'=>'Projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info']);
			 	else echo $this->Html->link(__('Retour'), ['controller'=>'Projets', 'action' => 'calendrier'],['class' => 'btn btn-info']);
			 ?>
			</div>
			<div class="col-md-8">
			<?= $this->Form->create($calendrierProjet, ['id'=>'edit_calendrierProjet_form','action' => 'edit']); ?>  
			<?= $this->Form->hidden('projet_id',['value' => $calendrierProjet->projet_id]);?>
				<div class="row">
					<label class="col-md-4 control-label" for="libelle">Intitulé <span class="obligatoire"><sup> *</sup></span></label>
                	<div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,
															'class' => 'form-control', 'value'=> $calendrierProjet->libelle,
                    										'type' => 'textarea', 'escape' => false,
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />				
				<?php 
				$mois = ['janvier'=>'janvier','Février'=>'Février','Mars'=>'Mars','Avril'=>'Avril','Mai'=>'Mai','Juin'=>'Juin',
						'Juillet'=>'Juillet','Août'=>'Août','Septembre'=>'Septembre','Octobre'=>'Octobre','Novembre'=>'Novembre','Décembre'=>'Décembre'];
				?>		
				<div class="row">
                	<label class="col-md-2 control-label" for="mois_debut">Mois <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('mois_debut', ['label' => false,'id'=>'mois_debut',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options'=>$mois, 'value'=> $calendrierProjet->mois_debut,
                    										'data-location' => 'bottom',
                    										'required' =>'required']); ?>
                    </div>                          
                	<label class="col-md-2 control-label" for="annee_debut">Année <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('annee_debut', ['label' => false,'id'=>'annee_debut',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text','value'=> $calendrierProjet->annee_debut,
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min4' ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />
				<div class="row">
                	<label class="col-md-2 control-label" for="mois_fin">Mois de fin <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('mois_fin', ['label' => false,'id'=>'mois_fin',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options'=>$mois,'value'=> $calendrierProjet->mois_fin,
                    										'data-location' => 'bottom',
                    										'required' =>'required']); ?>
                    </div>                          
                	<label class="col-md-2 control-label" for="annee_fin">Année de fin <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('annee_fin', ['label' => false,'id'=>'annee_fin',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text','value'=> $calendrierProjet->annee_fin,
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min4' ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />
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