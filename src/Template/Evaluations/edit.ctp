<div class="blocblanc">
<?php 
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
    <h2>Phase de diagnostic</h2>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
    <h2>Phase de mise en oeuvre et de suivi</h2>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
    <h2>Phase d'évaluation</h2>
<?php } ?>
    <h3>Bilan : <?= $evaluation->name ?></h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $evaluation->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($evaluation, ['id'=>'edit_evaluation_form','enctype' => 'multipart/form-data']); ?>
    		<?= $this->Form->hidden('demarche_id',['value' => $evaluation->demarche_id]);?>		    
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'value'=>$evaluation->name ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-2 control-label" for="synthese">Synthèse <span class="obligatoire"><sup> *</sup></span></label>
                	<div class="col-md-2 BoutonAide">
                	<a class="btn btn-xs btn-info" data-toggle="popover" title="Aide"
	                 		data-content="<?= strip_tags($message->valeur)?>"
	                        role="button">Aide</a>
                	
                	</div>
                    <div class="col-md-8"><?= $this->Form->input('synthese', ['label' => false,'id'=>'synthese',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 
                    										'value'=>$evaluation->synthese ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
<?php if(empty($evaluation->file)) { ?>
				<div class="row">
					<label class="col-md-4 control-label" for="file">Votre document <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('file', ['label' => false,'id'=>'file',
														   	'div' => false, 
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'file']); ?>
                    </div>
				</div><br /> 
<?php } else {?>				
				<div class="row">
					<label class="col-md-4 control-label" for="file_exist">Votre document <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-6"><?= $this->Form->input('file_exist', ['label' => false,'id'=>'file_exist',
														   	'div' => false,'value'=>$evaluation->file ,
															'class' => 'form-control', 'disabled' =>'disabled',
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
<?php }?>
				


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
