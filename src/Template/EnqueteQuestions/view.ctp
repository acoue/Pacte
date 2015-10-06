<div class="blocblanc">
	<h2>Administration - Question enquête de satisfaction</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Edition'), ['action' => 'edit', $enqueteQuestion->id],['class' => 'btn btn-default']) ?><br /><br />
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $enqueteQuestion->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">  
				<div class="row">
                	<label class="col-md-4 control-label" for="id">Identifiant </label>
                    <div class="col-md-8"><?= $this->Form->input('id', ['label' => false,'id'=>'id',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($enqueteQuestion->id),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="ordre">Ordre </label>
                    <div class="col-md-8"><?= $this->Form->input('ordre', ['label' => false,'id'=>'ordre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($enqueteQuestion->ordre),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="texte">Texte </label>
                    <div class="col-md-8"><?= $this->Form->input('texte', ['label' => false,'id'=>'texte',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 
                    										'value' => h($enqueteQuestion->name),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle">Libellé court </label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 
                    										'value' => h($enqueteQuestion->libelle),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="aide">Texte d'aide</label>
                    <div class="col-md-8"><?= $this->Form->input('aide', ['label' => false,'id'=>'aide',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'value' => h($enqueteQuestion->texte_aide),
                    										'disabled' => 'disabled']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="type">Type de question</label>
                	<div class="col-md-8"><?= $this->Form->input('type', ['label' => false,
                											'options' => ['1' => 'Choix parmis 5 les items', '2' => 'Choix parmis 10 entiers (note)'],
                											'div' => false,'value' => h($enqueteQuestion->type),
															'class' => 'form-control','disabled' => 'disabled']) ?>    
                	</div>
				</div>						
			<div class="col-md-1"></div>
		</div>
	</div>
</div>