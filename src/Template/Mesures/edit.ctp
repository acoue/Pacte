<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Edition d'une mesure à T0</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $mesure->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($mesure, ['id'=>'edit_mesure_form','enctype' => 'multipart/form-data']); ?>
    		<?= $this->Form->hidden('demarche_id',['value' => $mesure->demarche_id]);?>		    
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'value'=>$mesure->name ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="resultat">Evolutions des résultats intermédiares<br />Points forts et axes d'amélioration identifiés <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('resultat', ['label' => false,'id'=>'resultat',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 
                    										'value'=>$mesure->resultat ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
					<label class="col-md-4 control-label" for="file">Votre document <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-6"><?= $this->Form->input('file', ['label' => false,'id'=>'file',
														   	'div' => false,'value'=>$mesure->file ,
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
