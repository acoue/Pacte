<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Projet d'équipe</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
    		<?= $this->Form->create($projet,['id'=>'edit_projet_form']); ?>	
    		<?= $this->Form->hidden('id',['value' => $projet->id]);?>		    
				<div class="row">
					<label class="col-md-4 control-label" for="intitule">Intitulé du projet <span class="obligatoire"><sup> *</sup></span></label>
                	<div class="col-md-8"><?= $this->Form->input('intitule', ['label' => false,'id'=>'intitule',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->intitule,
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 		    
				<div class="row">
					<label class="col-md-4 control-label" for="deploiement">Modalité de déploiement <span class="obligatoire"><sup> *</sup></span>
					<br /><span class="text-muted">(Cadre organosationnel, ressources allouées, formation, etc.)</span> 
					</label>
                	<div class="col-md-8"><?= $this->Form->input('deploiement', ['label' => false,'id'=>'deploiement',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->deploiement,
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />
				<div class="row">
					<p align="center">
					<?php 
						$session = $this->request->session();
						if($session->read('Equipe.Diagnostic') == 0) {
							echo $this->Form->button('Suite', ['type'=>'submit', 'class' => 'btn btn-info']);
						} else {
							echo $this->Form->button('Enregistrer', ['type'=>'submit', 'class' => 'btn btn-default']);
						}
			    	echo $this->Form->end() ?>
			    	</p>                        
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div>	
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>	

