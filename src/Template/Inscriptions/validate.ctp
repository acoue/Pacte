<div class="blocblanc">
	<h2>Fiche d'engagement de la direction - Etape n°1</h2>
    <h3>Validation de l'engagement</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<?= $this->Form->create('Inscription', ['id'=>'validate_inscription_form', 'action' => 'validate']) ?>
			<div class="col-md-10"> 
				<div  class="row">
					Cette fiche permet une évaluation institutionnelle à la fois de la compréhension du projet Pacte 
					et de la capacité de votre institution pour mettre en œuvre une initiative de travail d'équipe. 
					Un score final peut vous aider à prendre une décision d’engagement éclairée.
				</div><br />
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-4 control-label" for="score">Noter le score obtenu </label>
					<div class="col-md-6">
						<?= $this->Form->input('score', ['label' => false,'id'=>'score',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => $score,
                    										'disabled' => 'disabled']); ?>
                    </div>		
					<div class="col-md-1"></div>
				</div><br />
				<div  class="row">		
					<div class="col-md-1"></div>
					<label class="col-md-4 control-label" for="mail">Email de contact </label>
					<div class="col-md-6">
						<?= $this->Form->input('mail', ['label' => false,'id'=>'mail',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text',
                    										'data-location' => 'bottom',
                    										'data-validation'=>'email',
															'required' =>'required']); ?>
                    </div>		
					<div class="col-md-1"></div>
				</div><br />
				<div  class="row">
					<div class="alert alert-info">
						<p align="center"><span class="label label-warning">Avertissement</span></p>
 						<p align="justify">
							 une fois validée, les données saisies précédemment ne seront plus modifibale, mais uniquement consultables.
							<br />
							A cette étape, vous pouvez décider de poursuivre votre démarche, et ainsi ...
							 Les données précédemment saisies seront stockée, ce qui vous permet d'interrompre votre saisie et de la reprendre ultérieurement.
							<br />
							Vous pouvez également décider de ne pas continuer, toutes les données saisies auparavant seront détruitent.
						</p>
					</div> 
				</div>
			</div><br />						
			<div class="col-md-1"></div>
		</div><br />
	<p align="center">
		<?= $this->Form->button('Vous souhaitez poursuivre', ['type' => 'submit','class' => 'btn btn-info']) ?><br /><br />
		<?= $this->Html->link('Vous ne souhaitez pas poursuivre', '/Inscriptions/validate/0', ['class' => 'btn btn-danger']);?><br /><br />
		<?= $this->Html->link('Retour', '/Inscriptions/create', ['class' => 'btn btn-default']);?>
	</p>
	</div>
	<?= $this->Form->end() ?>
</div>
