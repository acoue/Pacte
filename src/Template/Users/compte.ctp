<div class="blocblanc">
	<h2>Edition de son compte utilisateur</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<?= $this->Form->create('User', ['id'=>'compte_form', 'action' => 'compte']) ?>
			<div class="col-md-10"> 
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-4 control-label" for="pass1">Mot de passe </label>
					<div class="col-md-6">
						<?= $this->Form->input('pass1', ['label' => false,'id'=>'pass1',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'password', 
                    										'required' =>'required']); ?>
                    </div>		
					<div class="col-md-1"></div>
				</div><br />
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-4 control-label" for="pass2">Vérification du mot de passe </label>
					<div class="col-md-6">
						<?= $this->Form->input('pass2', ['label' => false,'id'=>'pass2',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'password','value'=>'',
															'required' =>'required']); ?>
                    </div>		
					<div class="col-md-1"></div>
				</div>
			</div><br />						
			<div class="col-md-1"></div>
		</div><br />
	<p align="center">
		<?= $this->Form->button('Valider', ['type' => 'submit','class' => 'btn btn-info']) ?>
	</p>
	</div>
	<?= $this->Form->end() ?>
</div>
