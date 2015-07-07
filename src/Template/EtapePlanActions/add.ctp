<div class="blocblanc">
<?php 
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
    <h2>Phase de diagnostic</h2>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
    <h2>Phase de mise en oeuvre</h2>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
    <h2>Phase d'évaluation</h2>
<?php } ?>
    <h3>Objectifs d'amélioration - Ajout d'une étape du plan d'action</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($etapePlanAction, ['id'=>'add_etape_form']); ?>    
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="pilote">Pilote <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('pilote', ['label' => false,'id'=>'pilote',
														   	'div' => false,'type' => 'text', 
															'class' => 'form-control',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />    
				<?php 
				$mois = ['janvier'=>'janvier','Février'=>'Février','Mars'=>'Mars','Avril'=>'Avril','Mai'=>'Mai','Juin'=>'Juin',
						'Juillet'=>'Juillet','Août'=>'Août','Septembre'=>'Septembre','Octobre'=>'Octobre','Novembre'=>'Novembre','Décembre'=>'Décembre'];
				?>	
				<div class="row">
                	<label class="col-md-3 control-label" for="mois">Echéance : Mois <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-4"><?= $this->Form->input('mois', ['label' => false,'id'=>'mois',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options'=>$mois, 
                    										'required' =>'required']); ?>
                    </div>     
                	<label class="col-md-2 control-label" for="annee">Année <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-3"><?= $this->Form->input('annee', ['label' => false,'id'=>'annee',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min4' ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />     
				<?php 
				$etat = ['En cours'=>'En cours','En attente'=>'En attente','Terminer'=>'Terminer'];
				?>	
				<div class="row">
                	<label class="col-md-4 control-label" for="etat">Etat</label>
                    <div class="col-md-8"><?= $this->Form->input('etat', ['label' => false,'id'=>'etat',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options' => $etat]); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="indicateur">Indicateur</label>
                    <div class="col-md-8"><?= $this->Form->input('indicateur', ['label' => false,'id'=>'indicateur',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="type_indicateur_id">Type d'indicateur</label>
                    <div class="col-md-8"><?= $this->Form->input('type_indicateur_id', ['label' => false,'id'=>'type_indicateur_id',
														   	'div' => false,
                    										['options' => $typeIndicateurs],
															'class' => 'form-control']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="modalite_suivi">Modalité de suivi</label>
                    <div class="col-md-8"><?= $this->Form->input('modalite_suivi', ['label' => false,'id'=>'modalite_suivi',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="resultat">Résultat</label>
                    <div class="col-md-8"><?= $this->Form->input('resultat', ['label' => false,'id'=>'resultat',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br /> 						
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