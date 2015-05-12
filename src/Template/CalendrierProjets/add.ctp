
			<?= $this->Form->create('calendrierProjet', ['id'=>'add_calendrierProjet_form','action' => 'add']); ?>  
			<?= $this->Form->hidden('projet',['value' => $projet->id]);?>
				<div class="row">
					<label class="col-md-4 control-label" for="intitule">Intitulé <span class="obligatoire"><sup> *</sup></span></label>
                	<div class="col-md-8"><?= $this->Form->input('intitule', ['label' => false,'id'=>'intitule',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 	

				<div class="row">
                	<label class="col-md-4 control-label" for="mois">Mois <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('email', ['label' => false,'id'=>'mois',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'data-location' => 'bottom',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="annee">Année <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('annee', ['label' => false,'id'=>'annee',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text',
                    										'data-validation'=>'length number', 
                    										'data-validation-length'=>'min4' ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />	
			  	<p align='left'><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>    		
			</div>
			<div class="modal-footer">
				<?= $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
		    	<?= $this->Form->end() ?>
		  		<button data-dismiss="modal" class="btn btn-info" type="button">Fermer</button>
			</div>




<div class="calendrierProjets form large-10 medium-9 columns">
    <?= $this->Form->create($calendrierProjet); ?>
    <fieldset>
        <legend><?= __('Add Calendrier Projet') ?></legend>
        <?php
            echo $this->Form->input('libelle');
            echo $this->Form->input('mois');
            echo $this->Form->input('annee');
            echo $this->Form->input('projet_id', ['options' => $projets, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
