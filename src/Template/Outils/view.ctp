<div class="blocblanc">
	<h2>Administration - Visualisation Outil</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit', $outil->id],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $outil->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $outil->id)]) ?><br /><br/>			
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">
				<div class="row">
					<label class="col-md-4 control-label" for="fichier">Fichier</label>
                    <div class="col-md-7"><?= $this->Form->input('fichier', ['label' => false,'id'=>'fichier',
														   	'div' => false, 'value' => h($outil->name),
															'class' => 'form-control',
                    										'type' => 'text', 'disabled' =>'disabled']); ?>
                    </div> 
                    <div class="col-md-1">
                    <?= $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/outil/'.h($outil->name), ['class' => 'titre','target' => '_blank','escape' => false]);?>
                    </div> 
				</div><br /> 	
				<div class="row">
					<label class="col-md-4 control-label" for="libelle">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false, 'value' => h($outil->libelle),
															'class' => 'form-control',
                    										'type' => 'text', 'disabled' =>'disabled']); ?>
                    </div>                     
				</div><br />		    
				<div class="row">
                	<label class="col-md-4 control-label" for="texte">Description</label>
                    <div class="col-md-8"><?= $this->Form->input('texte', ['label' => false,
														   	'div' => false, 'value' => h($outil->texte),
															'class' => 'form-control', 'disabled' =>'disabled',
                    										'type' => 'textarea', 'escape' => false,
															'rows' => '5', 'cols' => '80']); ?>
                    </div>                        
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="phase">Phase</label>
                    <div class="col-md-8"><?= $this->Form->input('phase', ['label' => false,
														   	'div' => false, 'value'=> $outil->phase->name,
															'class' => 'form-control',                     										
                    										'disabled' =>'disabled']); ?>
                    </div>                          
				</div><br />    		    
				<div class="row">
                	<label class="col-md-4 control-label" for="ordre">Ordre <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('ordre', ['label' => false,'id'=>'ordre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'value'=> $outil->ordre,
                    										'disabled' =>'disabled']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="type">Type</label>
                	<div class="col-md-8"><?= $this->Form->input('type', ['label' => false,
                												'div' => false, 'value'=> h($outil->type),
																'class' => 'form-control', 
                    											'disabled' =>'disabled']) ?>    
                	</div>                 
				</div>
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
	</div>
</div>   