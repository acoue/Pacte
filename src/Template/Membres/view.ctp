<div class="blocblanc">
	<h2>Administration - Membres </h2>
    <h3><?= h($membre->prenom)." ".h($membre->nom) ?></h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit/'.$membre->id.'/'.$comite.'/'.$type],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete/'.$membre->id.'/'.$comite.'/'.$type], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $membre->id)]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index/'.$comite.'/'.$type],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">  
				<div class="row">
                	<label class="col-md-4 control-label" for="role">Rôle au sein de l'équipe</label>
                    <div class="col-md-8"><?= $this->Form->input('role', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->responsabilite->name),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />    
				<div class="row">
                	<label class="col-md-4 control-label" for="prenom">Prénom </label>
                    <div class="col-md-8"><?= $this->Form->input('prenom', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->prenom),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Nom </label>
                    <div class="col-md-8"><?= $this->Form->input('nom', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->nom),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="email">Adresse Email </label>
                    <div class="col-md-8"><?= $this->Form->input('email', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->email),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="telephone">Ligne directe </label>
                    <div class="col-md-8"><?= $this->Form->input('"telephone"', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->telephone),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="fonction">Fonction </label>
                    <div class="col-md-8"><?= $this->Form->input('fonction', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->fonction),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="service">Service </label>
                    <div class="col-md-8"><?= $this->Form->input('service', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($membre->service),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
			</div>						
			<div class="col-md-1"></div>
		</div>
	</div>
</div>