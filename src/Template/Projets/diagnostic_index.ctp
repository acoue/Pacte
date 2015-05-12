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
					<label class="col-md-4 control-label" for="intitule">Calendrier de mise en oeuvre</label>
					<div class="col-md-6">
						<table cellpadding="0" cellspacing="0" class="table table-striped" >
						    <thead>
						        <tr>
						            <th width='60%'>Libellé</th>
						            <th width='20%'>Date</th>
						            <th class="actions"><?= __('Actions') ?></th>
						        </tr>
						    </thead>
						    <tbody>
						    <?php foreach ($calendriers as $calendrierProjet): ?>
						        <tr>            
						            <td><?= $calendrierProjet->libelle ?></td>
						            <td><?= $calendrierProjet->mois." ".$this->Number->format($calendrierProjet->annee) ?></td>						            
						            <td class="actions">
						            <?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['controller'=>'CalendrierProjets','action' => 'edit', $calendrierProjet->id], array('escape' => false)); ?>&nbsp;&nbsp;     
									<?= $this->Form->postLink('<span><i class="glyphicon glyphicon-trash"></i></span>',
							                ['controller'=>'CalendrierProjets','action' => 'delete', $calendrierProjet->id],
							                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer {0} ?']);?>
							    	</td>
						        </tr>
						
						    <?php endforeach; ?>
						    </tbody>
					    </table>
					</div>
					<div class="col-md-2">
						<?= $this->Html->link(__('Ajouter'),['controller'=>'CalendrierProjets', 'action'=>'add/'.$projet->id],['class'=>'btn btn-info']);?>
					</div>
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div><br /><br />
	<p align="center">
		<?= $this->Form->button('Enregistrer les modifications', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
    	
    	<?php 
    	//Si toujours en phase d'engagement
    	$session = $this->request->session();
    	if($session->read('Equipe.Diagnostic') == '0') {
    		echo "<br /><br />";
    		echo $this->Html->link(__('Suite'),['controller'=>'projets', 'action'=>'diagnostic_index'],['class'=>'btn btn-info']);
    	} 
    	?>			
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>	


