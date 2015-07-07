<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<div class="row">
					<div class="alert alert-success"><?= $message->valeur?> </div>			
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	<p align="center">
		<?= $this->Html->link('Poursuivre', ['controller'=>'pages', 'action'=>'home'], ['class' => 'btn btn-info']);?>
	</p>
	</div>
</div>