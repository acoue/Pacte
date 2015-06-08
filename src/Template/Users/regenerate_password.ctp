<div class="blocblanc">
	<h2>Administration - Régénération d'un mot de passe utilisateur Question </h2>
	<h3>Identifiant : <?= $user->username?> (rôle : <?= $user->role?>)</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
				<?= $this->Form->create('User', ['id'=>'password_form', 'action' => 'regeneratePassword']) ?>
				<?= $this->Form->hidden('id',['value' => $user->id]);?>	
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-1"></div>
	                	<label class="col-md-4 control-label" for="password">Mot de passe </label> 
	                    <div class="col-md-6"><?= $this->Form->input('password', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
																'placeholder' => 'Nouveau mot de passe',
	                    										'type' => 'text', 
																'required' =>'required']); ?>
	                    </div>
						<div class="col-md-1"></div>
					</div>
				</div> 					
			<div class="col-md-1"></div>
		</div><br /><br />
		<p align="center">
			<?= $this->Form->button('Envoyer', ['type' => 'submit','class' => 'btn btn-info']) ?>
		</p>
	</div>
	<?= $this->Form->end() ?>
</div>
