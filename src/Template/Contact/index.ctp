<div class="blocblanc">
<h2>Contacter la Haute Autorité de Santé</h2>
<div class="blocblancContent">
<div class="row">
<div class="col-md-2"></div>




<?= $this->Form->create($contact, ['id'=>'contact_form']) ?>
			<div class="col-md-8">
		 		<div class="row">
                	<label class="col-md-5 control-label" for="name">Nom - Prénom <span class="obligatoire"><sup> *</sup></span></label>
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
                	<label class="col-md-5 control-label" for="email">Votre email <span class="obligatoire"><sup> *</sup></span></label> 
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
                	<label class="col-md-5 control-label" for="body">Votre message <span class="obligatoire"><sup> *</sup></span></label> 
                    <div class="col-md-7"><?= $this->Form->textarea('body', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required']); ?>
                    </div>
				</div><br /> 
		 		<div class="row">
                	<label class="col-md-5 control-label" for="captcha">Recopiez le texte ci-contre : </label> 
                	<label class="col-md-3 control-label captcha"><?= $captcha?></label>
                	<div class="col-md-1">
                    <?=	$this->Html->image('reload.png', ['alt' => 'Recharger le code anti-robot','url' => ['controller' => 'Contact', 'action' => 'index']]); ?>
                	</div>
                    <div class="col-md-3"><?= $this->Form->input('captcha', ['label' => false,
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required']); ?>
                    </div>
				</div>      
				<div class="row"><span class="text-muted">Attention : le code de vérification tient compte des minuscules / majuscules</span></div>                
			</div>
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Form->button('Envoyer', ['type' => 'submit','class' => 'btn btn-default']) ?>
    </p>
<?= $this->Form->end() ?>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>