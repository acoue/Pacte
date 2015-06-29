<!-- src/Template/Users/add.ctp -->
<div class="blocblanc">
	<h2>Administration - Ajout Utilisateur </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>			
    		<?= $this->Form->create($user, ['id'=>'add_utilisateur_form']); ?>
    		<?= $this->Form->hidden('token',['value' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32)]);?>		  
			<?= $this->Form->hidden('active',['value' => '1']);?>		  
			<div class="col-md-8">   
				<div class="row">
                	<label class="col-md-4 control-label" for="username">Username <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('username', ['label' => false,'id'=>'username',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="password">Mot de passe (minimun : 8 caractères)<span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('password', ['label' => false,'id'=>'password',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'password', 
                    										'data-validation'=>'length',
															'data-validation-length'=>'min8',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />
				<div class="" id="messagePwd"></div>
				<br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="prenom">Prénom </label>
                    <div class="col-md-8"><?= $this->Form->input('prenom', ['label' => false,'id'=>'prenom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Nom </label>
                    <div class="col-md-8"><?= $this->Form->input('nom', ['label' => false,'id'=>'nom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="role">Rôle <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('role', ['label' => false,
                											'options' => ['' => 'Sélectionner', 'admin' => 'Administrateur', 'has' => 'CP HAS', 'expert' => 'Expert Visiteur'],
                											'div' => false,
															'class' => 'form-control', 
                    										'required' =>'required']) ?>    
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
