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
						<div class="alert alert-info">
							<b>Attention : Le mot de passe doit contenir au minimum 8 caractères.</b><br />
							Pour vous indiquerons la compléxité de votre mot de passe :
							<ul>
								<li>Si le mot de passe ne contient pas de lettres majuscules ou de chiffres, alors il est considéré comme de compléxité faible</li>
								<li>Si le mot de passe contient une lettre majuscule ou un nombre alors il est considéré comme de compléxité moyenne</li>
								<li>Si le mot de passe contient une lettre majuscule, un nombre et un caractère particulier alors il est considéré comme de compléxité forte</li>
							</ul>
						</div>			
					</div>
					<div class="row">
						<div class="col-md-1"></div>
	                	<label class="col-md-4 control-label" for="password">Mot de passe (minimun : 8 caractères)</label> 
	                    <div class="col-md-4"><?= $this->Form->input('password', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
																'placeholder' => 'Nouveau mot de passe',
	                    										'type' => 'password', 
                    											'data-validation'=>'length',
																'data-validation-length'=>'min8',
																'required' =>'required']); ?>
	                    </div>
	                    <div class="col-md-3">
	                    	<div class="" id="messagePwd"></div>
	                    </div>
					</div><br />					
					<div  class="row">		
						<div class="col-md-1"></div>
						<label class="col-md-4 control-label" for="mail">Email</label>
						<div class="col-md-6">
							<?= $this->Form->input('mail', ['label' => false,'id'=>'mail',
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                    										'data-location' => 'bottom',
	                    										'data-validation'=>'email',
																'required' =>'required']); ?>
	                    </div>		
						<div class="col-md-1"></div>
					</div><br />
					
					
					
					
					<div class="" id="messagePwd"></div>
				</div> 					
			<div class="col-md-1"></div>
		</div><br /><br />
		<p align="center">
			<?= $this->Form->button('Envoyer', ['type' => 'submit','class' => 'btn btn-info']) ?>
		</p>
	</div>
	<?= $this->Form->end() ?>
</div>
