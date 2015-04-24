<div class="blocblanc">
	<h2>Mot de passe oublié</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<?= $this->Form->create('User', ['id'=>'password_form', 'action' => 'password']) ?>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-1"></div>
                	<label class="col-md-4 control-label" for="identifiant">Identifiant </label> 
                    <div class="col-md-6"><?= $this->Form->input('identifiant', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Identifiant de connexion',
                    										'type' => 'text', 
															'required' =>'required']); ?>
                    </div>
					<div class="col-md-1"></div>
				</div><br />	 
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-4 control-label" for="email">Votre email de contact </label>
					<div class="col-md-6">
						<?= $this->Form->input('email', ['label' => false,'id'=>'email',
															   	'div' => false,
																'class' => 'form-control', 
																'placeholder' => 'Email de contact',
	                    										'type' => 'text', 
	                    										'required' =>'required',
																'data-validation' => 'email']); ?>
	                    </div>		
						<div class="col-md-1"></div>
					</div>
				</div><br /> 					
			<div class="col-md-1"></div>
		</div><br />
	<p align="center">
		<?= $this->Form->button('Envoyer', ['type' => 'submit','class' => 'btn btn-info']) ?>
	</p>
	</div>
	<?= $this->Form->end() ?>
</div>
