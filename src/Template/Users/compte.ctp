<div class="blocblanc">
	<h2>Edition de son compte utilisateur</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2"><?= $this->Html->link('Changer son mot de passe', ['controller'=>'users', 'action'=>'changePwd/'.$user->id], ['class' => 'btn btn-warning']);?>			
			</div>
			<?= $this->Form->create($user, ['id'=>'compte_form', 'action' => 'compte']) ?>
			<div class="col-md-8"> 
			
			   
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Nom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('nom', ['label' => false,'id'=>'nom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'value'=>$user->nom ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="prenom">Prénom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('pass2', ['label' => false,'id'=>'prenom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'texte', 'value'=>$user->prenom ,
															'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="username">Login <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('username', ['label' => false,'id'=>'username',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'texte', 'value'=>$user->username ,
															'required' =>'required']); ?>
                    </div>                          
				</div><br />
			</div><br />						
			<div class="col-md-1"></div>
		</div><br />
	
	<p align="center">
		<?= $this->Form->button('Valider', ['type' => 'submit','class' => 'btn btn-info']) ?>
		<?= $this->Form->end() ?>
	</p>
	</div>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
</div>
