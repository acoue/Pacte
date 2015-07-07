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
    <h3>Ajout d'une évaluation</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($evaluation, ['id'=>'add_evaluation_form','enctype' => 'multipart/form-data']); ?>
    		<?= $this->Form->hidden('demarche_id',['value' => $demarche_id]);?>		    
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
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
															'class' => 'form-control', 'rows' => '5', 'cols' => '80',
                    										'required' =>'required']); ?>
                    </div>                
				</div><br /> 
				<div class="row">
					<label class="col-md-4 control-label" for="file">Votre document <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('file', ['label' => false,'id'=>'file',
														   	'div' => false,
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'file']); ?>
                    </div>
				</div><br /> 		
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
	<p align="center">
		<?= $this->Form->button('Ajouter', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>
