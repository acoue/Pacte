<div class="blocblanc">
	<h2>Administration - Membres </h2>
<?php 
$session = $this->request->session();
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
					echo $this->Html->link(__('Edition'), ['action' => 'edit/'.$membre->id.'/'.$comite.'/'.$type.'/projet'],['class' => 'btn btn-default']);
					echo "<br /><br/>";
					echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete/'.$membre->id.'/'.$comite.'/'.$type.'/projet'], ['class'=>'btn btn-warning','confirm' => 'Etes-vous sûr de vouloir supprimer le membre ?']);
					echo "<br /><br/>";	
					echo $this->Html->link(__('Retour'), ['controller'=>'projets','action' => 'index'],['class' => 'btn btn-info']);
				} else {
					echo $this->Html->link(__('Edition'), ['action' => 'edit/'.$membre->id.'/'.$comite.'/'.$type],['class' => 'btn btn-default']);
					echo "<br /><br/>";
					echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete/'.$membre->id.'/'.$comite.'/'.$type], ['class'=>'btn btn-warning','confirm' => 'Etes-vous sûr de vouloir supprimer le membre ?']);
					echo "<br /><br/>";
					echo $this->Html->link(__('Retour'), ['action' => 'index/'.$comite.'/'.$type],['class' => 'btn btn-info']);
				} 
				
				if($session->read('Auth.User.role') === 'admin') echo "<br /><br/><button onclick='window.history.go(-1);' class='btn btn-info' >Visualisation démarche</button>";
			?>
			</div>
			<div class="col-md-8">
<?php if($comite == 0 && $type == 1) { //Ajout d'un membre referent?>
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
<?php } ?>
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