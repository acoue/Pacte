<div class="blocblanc">
	<h2>Edition de son compte utilisateur</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'compte/'.$user->id],['class' => 'btn btn-info']) ?><br /><br /> 
			</div>
			<?= $this->Form->create($user, ['id'=>'changePwd_form', 'action' => 'changePwd']) ?>
			<div class="col-md-8"> 
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
				<div  class="row">		
					<label class="col-md-4 control-label" for="pass1">Mot de passe (minimun : 8 caractères)</label>
					<div class="col-md-5">
						<?= $this->Form->input('pass1', ['label' => false,'id'=>'pass1',
															'class' => 'form-control', 
                    										'type' => 'password',
                    										'data-validation'=>'length',
															'data-validation-length'=>'min8', 
                    										'required' =>'required']); ?>
                    </div>	
                    <div class="col-md-3"><div class="" id="messagePwd"></div></div>	
				</div><br />
				<div  class="row">		
					<label class="col-md-4 control-label" for="pass2">Vérification du mot de passe </label>
					<div class="col-md-5">
						<?= $this->Form->input('pass2', ['label' => false,'id'=>'pass2',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'password','value'=>'',
															'required' =>'required']); ?>
                    </div>		
				</div><br />
				<div class="" id="messagePwdDifferent"></div>
			</div>						
			<div class="col-md-1"></div>
		</div>		
	<p align="center">
		<?= $this->Form->button('Valider', ['type' => 'submit','class' => 'btn btn-info']) ?>
		<?= $this->Form->end() ?>
	</p>
	</div>


