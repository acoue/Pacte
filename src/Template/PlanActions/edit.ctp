<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Objectifs d'amélioration</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($planAction, ['id'=>'edit_plan_form','enctype' => 'multipart/form-data']); ?>
			<div class="col-md-8"> 			    
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br />
				<div class="row">
					<label class="col-md-4 control-label" for="file">Votre document <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-6"><?= $this->Form->input('file', ['label' => false,'id'=>'file',
														   	'div' => false,'value'=>$planAction->file ,
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'text']); ?>
                    </div>
                    <div class="col-md-2">
                    	<a class="btn btn-danger" onclick="ChangeVisibilityAndTextInChamp('divDocument','file','Modification')">Modifier</a>                       
                    </div>
                    <!-- BLOC CACHES DEBUT --> 
<div id="divDocument" class="divCache"><br /><br />
	<div class="row">
		<div class="col-md-2"></div>
		<label class="col-md-3 control-label" for="file_new">Nouveau document</label>
        <div class="col-md-6"><?= $this->Form->input('file_new', ['label' => false,'id'=>'file_new',
														   	'div' => false,
															'class' => 'form-control',
                    										'type' => 'file']); ?>
        </div>
        <div class="col-md-1"></div>
	</div>
</div>
                    <!-- BLOC CACHES FIN --> 
				</div><br /> 
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

