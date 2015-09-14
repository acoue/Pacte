<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
<?php
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
    <h3>Evaluation à T0</h3>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
    <h3>Evaluation à T1</h3>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
    <h3>Evaluation à T2</h3>
<?php } ?>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?php
			if( !in_array($mesure->name,['Matrice de Maturité à T0','Matrice de Maturité à T1','Culture Sécurité à T2','Matrice de Maturité à T2'])) {
				echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $mesure->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]); 
			} 
			?><br /><br/>
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($mesure, ['id'=>'edit_mesure_form','enctype' => 'multipart/form-data']); ?>
    		<?= $this->Form->hidden('demarche_id',['value' => $mesure->demarche_id]);?>	
    		<?php 
//Pb de non remontée du name quand le champ est en disabled
    		if(in_array($mesure->name,['Matrice de Maturité à T0','Matrice de Maturité à T1','Culture Sécurité à T2','Matrice de Maturité à T2'])){
    			echo $this->Form->hidden('name',['id'=>'name','value' => $mesure->name]);
    		}
    		?>		    
			<div class="col-md-8">     
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8">
                    <?php 
                    if(!in_array($mesure->name,['Matrice de Maturité à T0','Matrice de Maturité à T1','Culture Sécurité à T2','Matrice de Maturité à T2'])) {
                    	echo $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'value'=>$mesure->name ,
                    										'required' =>'required']);
                    } else {
                    	echo $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 'value'=>$mesure->name ,
                    										'required' =>'required','disabled'=>'disabled']);
                    }                    
                    ?>
                    </div>                          
				</div><br />  
				<div class="row">
                	<label class="col-md-4 control-label" for="resultat">
<?php
if($session->read('Equipe.Diagnostic') == 0) { ?>
Evolutions des résultats initiaux<br />Points forts et axes d'amélioration identifiés <span class="obligatoire"><sup> *</sup></span>
<?php } else { ?>
Evolutions des résultats intermédiares<br />Points forts et axes d'amélioration identifiés <span class="obligatoire"><sup> *</sup></span>
<?php } ?>    		</label>
                	<div class="col-md-8"><?= $this->Form->input('resultat', ['label' => false,'id'=>'resultat',
														   	'div' => false,'type' => 'textarea', 'escape' => false,
															'class' => 'form-control', 'rows' => '5', 
                    										'value'=>$mesure->resultat ,
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 
<?php if(empty($mesure->file)) { ?>
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
														   	'div' => false,'value'=>$mesure->file ,
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

