<?php
/**
 * @copyright     Copyright (c) Haute Autorité de Santé. (http://www.has-sante.fr)
 * @link          http://www.has-sante.fr
 * @since         1.0
 */
$session = $this->request->session();
if($session->check('Auth.User.role')) $role = $session->read('Auth.User.role');
else $role='equipe';

$cakeDescription = 'Pacte ';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Programme d'Amélioration Continue du Travail en Equipe">
    <meta name="author" content="Haute Autorité de Santé">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('jquery-ui.css') ?>
    <?= $this->Html->css('jquery.minicolors.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>  
    <?= $this->CKEditor->loadJs() ?>
</head>
<body>
<noscript>
Votre navigateur ne supporte pas Javascript. L'application peut ne pas fonctionner correctement. 
</noscript>
    <div id="main">
    
	    <div style="background-color:#8BF0A6;width:100%;text-align:center;font: bold 20px verdana;">Environnement de DEVELOPPEMENT</div>
	        <!-- navbar -->
	        <nav class="navbar navbar-default navbar-static-top" role="navigation">
	            <div class="container">
	                <div class="navbar-header">
	                    <button class="navbar-toggle collapsed" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" type="button">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                    </button>
	                    
	                    <span class="header_logo">
	                    <?=	$this->Html->image('logo.png', ['height' => '60px', 'title' => 'Programme Pacte']); ?>
	                    </span>
	<!--                     <span class="header_titre">Pacte</span> -->
	                </div>
	                <!-- Menu -->
	                <?php 
	                if($session->check('Auth.User.role')) {
	                	if($role == 'admin') echo $this->element('menuAdmin');
	                	else if($role == 'expert') echo $this->element('menuExpert');
	                	else if($role == 'has') echo $this->element('menuHas');
	                	else if($role == 'equipe') echo $this->element('menuEquipe');
	                	else if($role == 'animateur') echo $this->element('menuAnimateur');
	                } else echo $this->element('menu'); ?>    
	                <!-- /.menu-->                
	            </div>
	        </nav>    
	        <!-- /.navbar -->
        
<!--  Div pour les Outils - Pas pour les admins-->
<?php if(! in_array($role,['has','expert','admin','animateur'])) { //Affichage Admin ?>
			 <div class="container">   
				 <div class="row">
	              	<div class="col-md-1"></div>
	            	<div class="col-md-10">
						<div class="divContainOutil">
			            	<div id="divImagePlus" class="divMontre">
			              		<?php echo $this->Html->link( $this->Html->image('div_montre.png', ['height' => '30px', 'title' => 'Montrer les outils']),
			                    						'javascript:ChangeVisibilityOutil("divOutil","divImagePlus")', 
			              								['escape' => false])."<span class='divOutil'>Vos outils</span><br />"; ?>
			              	</div>
			              
			              	<div id="divOutil" class="divCache">
		              			<?php echo $this->Html->link( $this->Html->image('div_cache.png', ['height' => '30px', 'title' => 'Cacher les outils']),
		                    						'javascript:ChangeVisibilityOutil("divOutil","divImagePlus")', 
		              								['escape' => false])."<span class='divOutil'>Vos outils</span><br />"; ?>
		              
							<?= $this->element('outil', ['menu' => '1', 'sous_menu' => '1']) ?>
							</div> 
						</div>
	              	</div>
	              	<div class="col-md-1"></div>
	            </div>
			</div><br />
<?php }?>        
	        <!-- Barre de progression des phases et sous-phases -->
	        <?= $this->element('progress'); ?>
	        <!-- /.Barre de progression des phases et sous-phases -->        
        
	        <!-- Contenu -->     
	        <div class="container">      
	            <!-- Div pour les message -->
	            <div class="row">
					<div class="col-md-3"></div>
	              	<div class="col-md-6">
						<?= $this->Flash->render('auth') ?>
	                  	<?= $this->Flash->render() ?>
	              	</div>
	              	<div class="col-md-3"></div>
	            </div>
	            <!--  Div Contenu  -->
	            <div class="row">                
	                <div class="col-md-12"><?= $this->fetch('content') ?> </div>
	            </div><br />        
	
	        
				<!-- Visualisation de sa démarche -->        
				<?php if($session->check('Auth.User.role') && $session->read('Progress.Menu') > 0) { ?>
				<div class="row">
					<div class="col-md-1"></div>
				    <div class="col-md-10"><p align='center' >
					<?= $this->Html->link('Voir l\'état de sa démarche', ['controller'=>'Equipes', 'action' => 'visualisation/0/'.$session->read('Equipe.Identifiant')],['class' => 'btn btn-default']) ?>
					</p></div>
					<div class="col-md-1"></div>
				</div><br />
				<?php } ?>  
			</div><br /><br />             
	        <!-- /.contenu -->     
                
	        <!-- Footer -->
	        <footer class="footer">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-5 text-footer-left">
	                    <?= $this->Html->link( $this->Html->image('footer-logo-has.png', ['height' => '40px', 'title' => 'Haute Autorité de Santé']),
	                    						"http://has-sante.fr", ['target' => '_blank', 'escape' => false]) ?>
	                    &copy; Haute Autorité de Sante 2015</div>
	                    <div class="col-md-5 text-footer-right">Version <?= $version ?><br /><?= $dateVersion ?></div>                    
	                    <div class="col-md-2 text-footer-right">
	                    <?= $this->Html->link('Mentions légales','/users/mentions')?>
	                    </div>
	                </div>
	            </div>
	        </footer><!-- /.footer -->
	    </div>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('validatr.js') ?>
    
    <?= $this->Html->script('form-validator/jquery.form-validator.js') ?>
 	<?= $this->Html->script('form-validator/messages_fr.js') ?>
      
    <?= $this->Html->script('jquery-ui.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('userScript.js') ?>    
    <?= $this->Html->script('userFunction.js') ?>  
    
    <?= $this->Html->script('jquery.minicolors.js') ?>
    <?= $this->Html->script('jquery.minicolors.min.js') ?>
    
    <?= $this->fetch('script') ?>
</body>
</html>
