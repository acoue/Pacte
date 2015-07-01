

<div class="blocblanc">
	<h2>Dossier d'engagement d'une équipe Pacte</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="alert alert-info">
					<p align="center"><span class="label label-warning">Avertissement</span></p>
 					<p align="justify">
					<?php if($equipes->count() == 1) { ?>
							L'établissement comprend une équipe déjà engagée pour ce numéro de démarche : 
					<?php } else { ?>
							L'établissement comprend <?= $equipes->count()?> équipes déjà engagées pour ce numéro de démarche : 
					<?php }?>
					</p>
				</div> 
			</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<?= $this->Form->create('Inscription', ['id'=>'verification_form']) ?>
			<div class="col-md-8">
				<ul>
    			<?php 
    			foreach ($equipes as $equipe): 
    				echo "<li>Etablissement : ".h($equipe->etablissement->numero_demarche)." - ".h($equipe->etablissement->libelle)." : ".h($equipe->name)."</li>"; 
    			endforeach; 
    			?>
                    </ul>      
			</div>
		  <div class="col-md-2"></div>
	  </div><br /><br />
	<p align="center">
		<?= $this->Html->link('Retour', '/Inscriptions/index', ['class' => 'btn btn-info']);?>
		<?= $this->Form->button('Poursuivre tout de même', ['type' => 'submit','class' => 'btn btn-default']) ?>
		<?= $this->Form->end() ?>
    </p>
	</div>
</div>