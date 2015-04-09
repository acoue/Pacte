<?php
/**
 * @copyright     Copyright (c) Haute Autorité de Santé. (http://www.has-sante.fr)
 * @link          http://www.has-sante.fr
 * @since         1.0
 */

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
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <div id="main">
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
                    <?=	$this->Html->image('logo.jpg', ['height' => '60px', 'alt' => 'Programme Pacte']); ?>
                    </span>
                    <span class="header_titre">Pacte</span>
                </div>
                <!-- Menu -->
                <?= $this->element('menu'); ?>    
                <!-- /.menu-->                
            </div>
        </nav>
        <!-- /.navbar -->
        
        <!-- Barre de progression des phases et sous-phases -->
        <?= $this->element('progress', ['menu' => '1', 'sous_menu' => '1']); ?>
        <!-- /.Barre de progression des phases et sous-phases -->
        
        
        <!-- Contenu -->     
        <div class="container">
            <!-- Div pour les message -->
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                  <?= $this->Flash->render() ?>
              </div>
              <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                	<?= $this->element('outil', ['menu' => '1', 'sous_menu' => '1']); ?>
                </div>
                <div class="col-md-9"><?= $this->fetch('content') ?> </div>
                <div class="col-md-1"></div>                      
            </div>
            <br /><br />
        </div>
        <!-- /.contenu -->
                
        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-footer-left">&copy; Haute Autorité de Sante</div>
                    <div class="col-md-5 text-footer-right">Version 1.0</div>
                    <div class="col-md-1 text-footer-right"><a href="#">A propos</a></div>
                </div>
            </div>
        </footer><!-- /.footer -->
    </div>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('script.js') ?>    
    <?= $this->fetch('script') ?>
</body>
</html>
