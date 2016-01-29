<div class="blocblanc">
	<h2>Administration - Utilisateur </h2>
    <h3><?= $user->prenom." ".$user->nom ?></h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit', $user->id],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $user->id)]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">  
				<div class="row">
                	<label class="col-md-4 control-label" for="id">Identifiant </label>
                    <div class="col-md-8"><?= $this->Form->input('id', ['label' => false,'id'=>'id',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->id),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Username </label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->username),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="prenom">Prénom </label>
                    <div class="col-md-8"><?= $this->Form->input('prenom', ['label' => false,'id'=>'prenom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->prenom),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Nom </label>
                    <div class="col-md-8"><?= $this->Form->input('nom', ['label' => false,'id'=>'nom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->nom),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="role">Rôle </label>
                    <div class="col-md-8"><?= $this->Form->input('role', ['label' => false,'id'=>'role',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->role),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="email">Email </label>
                    <div class="col-md-8"><?= $this->Form->input('email', ['label' => false,'id'=>'email',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->email),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />    
				<div class="row">
                	<label class="col-md-4 control-label" for="actif">Compte actif </label>
                    <div class="col-md-8"><?= $this->Form->input('actif', ['label' => false,'id'=>'actif',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => (h($user->active)==1) ? "Oui" : "Non",
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />    
				<div class="row">
                	<label class="col-md-4 control-label" for="dateLogin">Date de dernière connexion</label>
                    <div class="col-md-8"><?= $this->Form->input('dateLogin', ['label' => false,'id'=>'dateLogin',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->lastlogin),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 
			</div>						
			<div class="col-md-1"></div>
		</div>
	</div>
</div>