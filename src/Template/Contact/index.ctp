<div class="blocblanc">
<h2>Contacter la Haute Autorité de Santé</h2>
<div class="blocblancContent">
<div class="row">
<div class="col-md-2"></div>




<?= $this->Form->create($contact, ['id'=>'contact_form']) ?>
			<div class="col-md-8">
		 		<div class="row">
                	<label class="col-md-5 control-label" for="name">Nom - Prénom </label>
                    <div class="col-md-7"><?= $this->Form->input('name', ['id'=>'name',
                    										'label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Identité', 
															'required' =>'required',
                    										'data-location' => 'bottom',
                    										'data-validation'=>'length',
                    										'data-validation-length'=>'min10']); ?>
                    </div>                          
				</div><br /> 
		 		<div class="row">
                	<label class="col-md-5 control-label" for="email">Votre email<br />                	
                	</label> 
                    <div class="col-md-7"><?= $this->Form->input('email', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
															'placeholder' => 'Adresse email',
                    										'type' => 'text', 
															'required' =>'required',
                    										'data-validation'=>'email']); ?>
                    </div>
				</div><br /> 
		 		<div class="row">
                	<label class="col-md-5 control-label" for="body">Votre message<br />                	
                	</label> 
                    <div class="col-md-7"><?= $this->Form->textarea('body', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required']); ?>
                    </div>
				</div>                    
			</div>
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Form->button('Envoyer', ['type' => 'submit','class' => 'btn btn-default']) ?>
    </p>
<?= $this->Form->end() ?>
	</div>
</div>