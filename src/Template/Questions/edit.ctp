<div class="blocblanc">
	<h2>Administration - Edition Question </h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $question->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer la question ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($question, ['id'=>'edit_question_form']); ?>
			<div class="col-md-8">   
				<div class="row">
                	<label class="col-md-4 control-label" for="ordre">Ordre <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('ordre', ['label' => false,'id'=>'ordre',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'value' => h($question->ordre), 
															'required' =>'required',
                    										'data-validation'=>'number']); ?>
                    </div>                          
				</div><br />   
				<div class="row">
                	<label class="col-md-4 control-label" for="libelle">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('libelle', ['label' => false,'id'=>'libelle',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
															'required' =>'required', 
                    										'value' => h($question->name)]); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="texte">Texte <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('texte', ['label' => false,'id'=>'texte',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80', 
															'required' =>'required',
                    										'value' => h($question->texte)]); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="texte_aide">Texte d'aide <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('texte_aide', ['label' => false,'id'=>'texte_aide',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 'cols' => '80', 
															'required' =>'required',
                    										'value' => h($question->texte_aide)]); ?>
                    </div>                          
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div><br /><br />
	<p align="center">
		<?= $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
    	
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>
