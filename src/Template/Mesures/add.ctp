<div class="blocblanc">
<?php
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
	<h2>Phase de diagnostic</h2>
    <h3>Evaluation à T0</h3>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
	<h2>Phase de Mise en Oeuvre</h2>
    <h3>Evaluation à T1</h3>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
	<h2>Phase d'Evaluation</h2>
    <h3>Evaluation à T2</h3>
<?php } ?>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
    		<?= $this->Form->create($mesure, ['id'=>'add_mesure_form','enctype' => 'multipart/form-data']); ?>
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
                	<label class="col-md-4 control-label" for="resultat">
<?php
if($session->read('Equipe.Diagnostic') == 0) { ?>
Evolution des résultats initiaux<br />Points forts et axes d'amélioration identifiés <span class="obligatoire"><sup> *</sup></span>
<?php } else { ?>
Evolution des résultats intermédiares<br />Points forts et axes d'amélioration identifiés <span class="obligatoire"><sup> *</sup></span>
<?php } ?>    		</label>
                    <div class="col-md-8"><?= $this->Form->input('resultat', ['label' => false,'id'=>'resultat',
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