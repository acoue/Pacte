<div class="blocblanc">
	<h2>Administration - Edition Utilisateur </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $user->id)]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($user, ['id'=>'edit_utilisateur_form']); ?>
			<div class="col-md-8">   
				<div class="row">
                	<label class="col-md-4 control-label" for="username">Username <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('username', ['label' => false,'id'=>'username',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($user->username),
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="role">Rôle <span class="obligatoire"> *</span></label>
                	<div class="col-md-8"><?= $this->Form->input('role', ['label' => false,
                											'options' => ['' => 'Sélectionner', 'admin' => 'Administrateur',  'has' => 'CP HAS', 'equipe' => 'Equipe', 'expert' => 'Expert Visiteur'],
                											'div' => false,
															'class' => 'form-control', 
                    										'value' => h($user->role),
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
			