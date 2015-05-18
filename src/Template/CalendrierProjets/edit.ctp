<!-- src/Template/CalendrierProjets/edit.ctp -->
<div class="blocblanc">
	<h2>Administration - Edition d'une étape dans le calendrier</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			 
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $calendrierProjet->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['controller'=>'Projets', 'action' => 'diagnostic_index'],['class' => 'btn btn-info']) ?>
			
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
				<div class="row">
                	<label class="col-md-4 control-label" for="mois">Mois <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('mois', ['label' => false,'id'=>'mois',
														   	'div' => false,
															'class' => 'form-control', 'value'=> $calendrierProjet->mois,
                    										'type' => 'text', 
                    										'data-location' => 'bottom',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="annee">Année <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('annee', ['label' => false,'id'=>'annee',
														   	'div' => false,
															'class' => 'form-control', 'value'=> $calendrierProjet->annee,
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