<!-- src/Template/CalendrierProjets/add.ctp -->
<div class="blocblanc">
	<h2>Administration - Ajout d'une étape dans le calendrier</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?php 
				$session = $this->request->session();
				if($session->read('Equipe.Diagnostic') == '0') echo $this->Html->link(__('Retour'), ['controller'=>'Projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info']);
				else echo $this->Html->link(__('Retour'), ['controller'=>'Projets', 'action' => 'calendrier'],['class' => 'btn btn-info']);
			?>
			</div>
			<div class="col-md-8">
			<?= $this->Form->create('calendrierProjet', ['id'=>'add_calendrierProjet_form','action' => 'add']); ?>  
			<?= $this->Form->hidden('projet_id',['value' => $projet->id]);?>
				<div class="row">
					<label class="col-md-4 control-label" for="libelle">Intitulé <span class="obligatoire"><sup> *</sup></span></label>
                	<div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,
															'class' => 'form-control', 
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
                	<label class="col-md-2 control-label" for="mois_debut">Mois de début <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('mois_debut', ['label' => false,'id'=>'mois_debut',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options'=>$mois 	,
                    										'data-location' => 'bottom',
                    										'required' =>'required']); ?>
                    </div>                          
                	<label class="col-md-2 control-label" for="annee_debut">Année de début <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('annee_debut', ['label' => false,'id'=>'annee_debut',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text',
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
                    										'options'=>$mois 	,
                    										'data-location' => 'bottom',
                    										'required' =>'required']); ?>
                    </div>                          
                	<label class="col-md-2 control-label" for="annee_fin">Année de fin <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('annee_fin', ['label' => false,'id'=>'annee_fin',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text',
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