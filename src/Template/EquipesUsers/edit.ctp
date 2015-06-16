<div class="blocblanc">
	<h2>Administration - Ajout Relation Equipes / Utilisateurs </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $equipesUser->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer la relation ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($equipesUser); ?>
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-4 control-label" for="equipe_id">Equipe </label>
                    <div class="col-md-8"><?= $this->Form->input('equipe_id', ['label' => false,'id'=>'equipe_id',
														   	'div' => false,
															'class' => 'form-control',
                    										'value'=> $equipesUser->equipe_id,
                    										['options' => $equipes]]); ?>
                    </div>                          
				</div><br />     
				<div class="row">
                	<label class="col-md-4 control-label" for="user_id">Utilisateur </label>
                    <div class="col-md-8"><?= $this->Form->input('user_id', ['label' => false,'id'=>'user_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										'value'=> $equipesUser->user_id,
                    										['options' => $users]]); ?>
                    </div>                          
				</div><br /> 
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
	<p align="center">
		<?= $this->Form->button('Modifier', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
	</p>
	</div>
</div>

