<!-- src/Template/Users/login.ctp -->
<br />
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">


		<div class="users form_login">
		<!-- Formulaire de connexion -->
			<?= $this->Form->create() ?>
			<legend>Connectez-vous</legend>
			<?= $this->Form->input('username', array('label' => false,'div' => false,'class' => 'form-control', 'size' => '70px', 'placeholder' => 'Identifiant', 'required' =>'required','autofocus'=>'autofocus')); ?><br />
			<?= $this->Form->input('password', array('label' => false,'div' => false, 'class' => 'form-control','size' => '70px', 'type'=>'password','placeholder' => 'Mot de passe', 'required' =>'required')); ?><br />
			<p align="center"><?= $this->Form->button('Se connecter', ['class' => 'btn btn-default']) ?></p>
			<?= $this->Form->end() ?>
		
		
		<p align="center"><?= $this->Html->link('Mot de passe oublié ?','/users/password') ?></p>
		
		<legend>Engagez-vous</legend>
		<p align="center">
			<?= $this->Html->link('Pas encore inscrit','/Inscriptions/index',['class' => 'btn btn-default', 'title' => 'Démarrez la procédure d\'inscription']) ?>
		</p>
		<br />
		<legend>Animateur CRM</legend>
		<p align="center">
			<?= $this->Html->link('Obtenir un compte','/users/createCompteAnimateur',['class' => 'btn btn-default', 'title' => 'Création d\'un compte animateur CRM']) ?>
		</p>
		
		
				
		</div><br /><br />
		<div class="row">
        	<?= $messageCnil ?>    
        </div><br />
	</div>
	<div class="col-md-3"></div>
</div>
       
<p class="text-muted" align='center'> 
<?=	$this->Html->image('info.png', ['height' => '24px']); ?>    
<u><b>Compatibilité des navigateurs :</b></u> Ce site est testé sur les navigateurs Internet Explorer (version supérieur à 9), Mozilla Firefox et Google Chrome. <br />
Ce site utilise JavaScript pour certaines fonctionnalités. Il est donc obligatoire d'activer la fonction JavaScript de votre navigateur. 
</p>
		
