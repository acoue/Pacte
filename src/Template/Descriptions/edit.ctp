<div class="blocblanc">
	<h2>Le projet Pacte</h2>
    <h3>Description de l'équipe - Edition d'une fonction</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">			
			<?= $this->Form->postLink(__('Supprimer'), ['controller'=>'descriptions','action' => 'delete', $description->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer la description pour cette fonction ?')]) ?><br /><br/>			
			<?= $this->Html->link(__('Retour'), ['controller'=>'projets','action' => 'index'],['class' => 'btn btn-info']) ?>
			</div>
    		<?= $this->Form->create($description, ['id'=>'edit_description_form']); ?> 
    		<?= $this->Form->hidden('projet_id',['value' => $description->projet_id]);?>		  
			<div class="col-md-8">  
				<div class="row">
                	<label class="col-md-4 control-label" for="fonction_id">Fonction <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('fonction_id', ['label' => false,
                											'div' => false,
															'class' => 'form-control', 
                    										'required' =>'required']) ?>    
                	</div>                 
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="nb_etp">Nombre d'ETP <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('nb_etp', ['label' => false,'id'=>'nb_etp',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required',
                    										'data-validation'=>'number']); ?>
                    </div>                          
				</div>
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

