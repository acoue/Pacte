<div class="blocblanc">
	<h2>Administration - Question </h2>
    <h3><?= h($question->name) ?></h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit', $question->id],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $question->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $question->id)]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">  
				<div class="row">
                	<label class="col-md-4 control-label" for="id">Identifiant </label>
                    <div class="col-md-8"><?= $this->Form->input('id', ['label' => false,'id'=>'id',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($question->id),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="ordre">Ordre </label>
                    <div class="col-md-8"><?= $this->Form->input('ordre', ['label' => false,'id'=>'ordre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($question->ordre),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle">Libellé </label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($question->name),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="texte">Texte </label>
                    <div class="col-md-8"><?= $this->Form->input('texte', ['label' => false,'id'=>'texte',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'value' => h($question->texte),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="texte_aide">Texte d'aide</label>
                    <div class="col-md-8"><?= $this->Form->input('texte_aide', ['label' => false,'id'=>'texte_aide',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'value' => h($question->texte_aide),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div>
	</div>
</div>