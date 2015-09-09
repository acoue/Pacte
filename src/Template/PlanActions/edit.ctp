<div class="blocblanc">
<?php 
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
    <h2>Phase de diagnostic</h2>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
    <h2>Phase de mise en oeuvre</h2>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
    <h2>Phase d'évaluation</h2>
<?php } ?>
    <h3>Plan d'action</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
    		<?= $this->Form->create($planAction, ['id'=>'edit_plan_form','enctype' => 'multipart/form-data']); ?>
			<div class="col-md-10"> 
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">Vous avez choisis d'utiliser votre propre plan d'action ...... </div>
					<div class="col-md-1"></div>
				</div><br />	    
				<div class="row">
                	<label class="col-md-4 control-label" for="name">Libellé <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('name', ['label' => false,'id'=>'name',
														   	'div' => false,
															'class' => 'form-control', 'required' =>'required',
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br />
<?php if(empty($planAction->file)) { ?>
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
					<label class="col-md-3 control-label" for="file_exist">Votre document <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-1">
                    
                    <?= $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/userDocument/'.$session->read('Auth.User.username').'/'.h($planAction->file), ['class' => 'titre','target' => '_blank','escape' => false]) ?>
					
                    </div>
                    
                    
                    <div class="col-md-6"><?= $this->Form->input('file_exist', ['label' => false,'id'=>'file_exist',
														   	'div' => false,'value'=>$planAction->file ,
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
	<?php
			$session = $this->request->session();
			if($session->read('Equipe.Diagnostic') == '1') {
				echo $this->Html->link('Retour', ['controller'=>'pages','action' => 'home'], ['class' => 'btn btn-info']);
				echo "&nbsp;&nbsp;";
				echo $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']); 
			} else {
				echo $this->Html->link(__('Retour'),['controller'=>'Evaluations', 'action'=>'index'],['class'=>'btn btn-info']);
				echo "&nbsp;&nbsp;";
				echo $this->Form->button('Suite', ['type'=>'submit', 'class' => 'btn btn-default']);
			}
			?>
			 
    	<?= $this->Form->end() ?>
    	<br /><br />
    	<?= $this->Html->link(__('Supprimer le plan d\'action'), ['controller'=>'PlanActions','action' => 'delete', $planAction->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?>
		
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>     

