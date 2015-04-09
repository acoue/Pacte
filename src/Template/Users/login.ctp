<!-- src/Template/Users/login.ctp -->
<?= $this->Flash->render('auth') ?>
<div class="users form_login">
<!-- Formulaire de connexion -->
	<?= $this->Form->create() ?>
	<legend>Connectez-vous</legend>
	<?= $this->Form->input('username', array('label' => false,'div' => false,'class' => 'form-control', 'size' => '70px', 'placeholder' => 'Identifiant', 'required' =>'required','autofocus'=>'autofocus')); ?><br />
	<?= $this->Form->input('password', array('label' => false,'div' => false, 'class' => 'form-control','size' => '70px', 'type'=>'password','placeholder' => 'Mot de passe', 'required' =>'required')); ?><br />
	<p align="center"><?= $this->Form->button('Se connecter', ['class' => 'btn btn-default']) ?></p>
	<?= $this->Form->end() ?>


<p align="center"><a href="#">Mot de passe oublié ?</a></p>

<legend>Engagez-vous</legend>
<p align="center"><a class="btn btn-default" title="Démarrez la procédure d'inscription" href="inscription.html">Pas encore inscrit</a></p>

</div>


