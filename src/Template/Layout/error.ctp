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
    <div id="main">   
       	<!-- Contenu -->    
       	<div id="container">
        	<div id="content">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
        	</div>
	    </div> <br /><br />             
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
	                    <div class="col-md-2 text-footer-right"></div>
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

