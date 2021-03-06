<div class="blocblanc">
	<h2>Administration - Membres </h2>
<?php 
if($comite == 1) echo "<h3 class='modal-title'>Visualisation d'un membre du comité de pilotage</h3>";
else if ($comite == 0) echo "<h3 class='modal-title'>Visualisation d'un membre de l'équipe</h3>";
else echo "<h3 class='modal-title'>Visualisation d'un membre</h3>";
?>	
    <h4><?= h($membre->prenom)." ".h($membre->nom) ?></h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?php 
			//Gestion des boutons en fonction d'ou l'on vient : de la gestion du projet (= $url non vide) ou des membres ($url = vide)
				if($url) {
					echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete/'.$membre->id.'/'.$comite.'/'.$type.'/projet'], ['class'=>'btn btn-warning','confirm' => 'Etes-vous sûr de vouloir supprimer le membre ?']);
					echo "<br /><br/>";	
					echo $this->Html->link(__('Retour'), ['controller'=>'projets','action' => 'index'],['class' => 'btn btn-info']);
				} else {
					echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete/'.$membre->id.'/'.$comite.'/'.$type], ['class'=>'btn btn-warning','confirm' => 'Etes-vous sûr de vouloir supprimer le membre ?']);
					echo "<br /><br/>";
					echo $this->Html->link(__('Retour'), ['action' => 'index/'.$comite.'/'.$type],['class' => 'btn btn-info']);
				}
			?>
			</div>
    		<?= $this->Form->create($membre, ['id'=>'edit_membre_form']); ?>
    		<?= $this->Form->hidden('comite',['value' => $membre->comite]);?>
    		<?= $this->Form->hidden('type',['value' => $type]);?>	
			<div class="col-md-8">	
<?php if($comite == 0) { //Ajout d'un membre referent?>	    
				<div class="row">
                	<label class="col-md-4 control-label" for="responsabilite_id">Rôle au sein de l'équipe <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('responsabilite_id', ['label' => false,'id'=>'responsabilite_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										['options' => $responsabilites],
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />
<?php } ?>      
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Nom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('nom', ['label' => false,'id'=>'nom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Prénom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('prenom', ['label' => false,'id'=>'prenom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="fonction">Fonction <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('fonction', ['label' => false,'id'=>'fonction',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type'=>'text',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="service">Service <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('service', ['label' => false,'id'=>'service',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type'=>'text',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="email">Adresse Email <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('email', ['label' => false,'id'=>'email',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'data-location' => 'bottom',
                    										'data-validation'=>'email',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="telephone">Ligne directe  <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('telephone', ['label' => false,'id'=>'telephone',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
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
