<div class="blocblanc">
	<h2>Fiche d'engagement de l'équipe</h2>
<?php 
if($comite == 1) echo "<h3 class='modal-title'>Ajout d'un membre du comité de pilotage</h3>";
else if ($comite == 0) echo "<h3 class='modal-title'>Ajout d'un membre de l'équipe</h3>";
else echo "<h3 class='modal-title'>Ajout d'un membre</h3>";
?>	
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['controller'=>'projets','action' => 'index'],['class' => 'btn btn-info']) ?>
			</div>	  
			<div class="col-md-8"> 
			<?= $this->Form->create('membre', ['id'=>'add_membre_form','action' => 'add']); ?>  
			<?= $this->Form->hidden('comite',['value' => $comite]);?>		    
			<?= $this->Form->hidden('type',['value' => $type]);?>		    
<?php if($comite == 0 && $type == 1) { //Ajout d'un membre referent?>
				<div class="row">
                	<label class="col-md-4 control-label" for="responsabilite_id">Type de membres <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('responsabilite_id', ['label' => false,'id'=>'responsabilite_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										['options' => $responsabilites],
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />   
<?php } else if($comite == 1) { echo $this->Form->hidden('responsabilite_id',['value' => '5']); //Ajout d'un membre du comite?>   

<?php } else echo $this->Form->hidden('responsabilite_id',['value' => '1']); //Ajout d'un membre ?> 
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
                    										'type' => 'text', 
															'class' => 'form-control',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="service">Service <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('service', ['label' => false,'id'=>'service',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
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
				</div>	
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

