<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Objectifs d'amélioration - Edition d'une étape du plan d'action</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($etapePlanAction, ['id'=>'edit_etape_form']); ?>    
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
				<div class="row">
                	<label class="col-md-4 control-label" for="mois">Echéance : Mois <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('mois', ['label' => false,'id'=>'mois',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />    
				<div class="row">
                	<label class="col-md-4 control-label" for="annee">Echéance : Année <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('annee', ['label' => false,'id'=>'annee',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min4' ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="etat">Etat</label>
                    <div class="col-md-8"><?= $this->Form->input('etat', ['label' => false,'id'=>'etat',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
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
                    										['options' => $typeIndicateurs, 'empty' => true],
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
		<?= $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>
