<?php 
// debug($descriptions);
// die();
?>
<div class="blocblanc">
	<h2>Fiche d'engagement de l'équipe</h2>
    <h3>Le projet Pacte</h3>    
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
    		<?= $this->Form->create($projet,['id'=>'edit_projet_form']); ?>	
    		<?= $this->Form->hidden('id',['value' => $projet->id]);?>		    
				<div class="row">
					<h4>Mission / Vision / Valeurs de l'équipe</h4>
					<p>Quelle est votre raison d’être (mission) ? Qu’est-ce qui est important pour votre équipe (valeurs) ?<br/>
					Quelles sont vos perspectives (vision) ?</p>
                	<div class="col-md-8"><?= $this->Form->input('mission', ['label' => false,'id'=>'mission',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->mission,
                											'rows' => '5', 'cols' => '100']); ?>
                    </div>                          
				</div><br /> 		    
				<div class="row">
					<h4>Description de l'équipe</h4>   
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<table cellpadding="0" cellspacing="0" class="table table-striped" >
								<thead>
									<tr>
					    	        	<th>Fonction</th>
						            	<th>Nombre d'ETP</th>
						            	<th>Service</th>
						        	</tr>
								</thead>
								<tbody>	
							    	<?php foreach ($descriptions as $description): ?>
							    	<tr>
							    		<td><?= h($description->fonction->name) ?></td>
			            				<td><?= h($description->nb_etp) ?></td>
			            				<td><?= h($description->service) ?></td>
							    	</tr>						    
						    		<?php endforeach; ?>								  
							    	<tr>
							    		<td colspan='3' align='center'>
							    		<?= $this->Html->link(__('Gestion de la description de l\'équipe'), ['controller'=>'descriptions', 'action' => 'index/'.$projet->id],['class' => 'btn btn-warning']) ?>
										</td>
							    	</tr> 							
								</tbody>							
							</table>
						    
						
						</div>
						<div class="col-md-1"></div>
					</div>					                             
                	<p align="center">
                    	<a class="btn btn-info" title="Liste constitution équipe" onclick="ChangeVisibility('divEquipe')">Constitution équipe</a>
                        <a class="btn btn-info" title="Liste Comité de pilotage" onclick="ChangeVisibility('divComitePilotage')">Comité de pilotage</a>
                    </p>      

<!-- BLOC CACHES DEBUT --> 
<div id="divEquipe" class="divCache">
	<div class="row">
		<div class="col-md-12">
		    <table cellpadding="0" cellspacing="0" class="table table-striped" >  
		        <caption>Constitution de l'équipe</caption>
		        <thead>
		        	<tr>
		        		<th width='15%'>Rôle</th>
		            	<th>Prénom</th>
		            	<th>Noms</th>
		            	<th>Fonction</th>
		            	<th>Service</th>
		        	</tr>
		        <thead>
		        <tbody>    
				<?php foreach ($membres as $membre): ?>
					<tr>
						<td><b><?= h($membre->responsabilite->name) ?></b></td>
			            <td><?= h($membre->prenom) ?></td>
			            <td><?= h($membre->nom) ?></td>
			            <td><?= h($membre->fonction) ?></td>
			            <td><?= h($membre->service) ?></td>			            
			        </tr>
			    <?php endforeach; ?>  
			    	<tr>
			    		<td colspan='5' align='center'>
			    		<?= $this->Html->link(__('Gestion des membres de l\'équipe'), ['controller'=>'membres', 'action' => 'index/0/0'],['class' => 'btn btn-warning']) ?>
						</td>
			    	</tr>      
		        </tbody>
		        </table>
		</div>
	</div>
</div>
<div id="divComitePilotage" class="divCache">
	<div class="row">
		<div class="col-md-12">
		    <table cellpadding="0" cellspacing="0" class="table table-striped" >  
		        <caption>Constitution du comité de pilotage</caption>
		        <thead>
		        	<tr>
		            	<th>Prénom</th>
		            	<th>Noms</th>
		            	<th>Fonction</th>
		            	<th>Service</th>
		        	</tr>
		        <thead>
		        <tbody>    
				<?php foreach ($membres_comites as $comite): ?>
					<tr>
			            <td><?= h($comite->prenom) ?></td>
			            <td><?= h($comite->nom) ?></td>
			            <td><?= h($comite->fonction) ?></td>
			            <td><?= h($comite->service) ?></td>			           
			        </tr>
			    <?php endforeach; ?>    
			    	<tr>
			    		<td colspan='4' align='center'>
			    		<?= $this->Html->link(__('Gestion des membres du comité de pilotage'), ['controller'=>'membres', 'action' => 'index/1/0'],['class' => 'btn btn-warning']) ?>
						</td>
			    	</tr>        
		        </tbody>
		        </table>
		</div>
	</div>             
</div>
<!-- BLOC CACHES FIN -->            
				</div><br /> 		    
				<div class="row">
					<h4>Lister le ou les secteur(s) d'activité(s) participant au projet Pacte <span class="obligatoire"><sup> *</sup></span></h4>
                	<div class="col-md-8"><?= $this->Form->input('secteur_activite', ['label' => false,'id'=>'secteur_activite',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->secteur_activite,
                											'rows' => '5', 'cols' => '100',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 		    
				<div class="row">
					<h4>Définir le projet d'équipe <span class="obligatoire"><sup> *</sup></span></h4>
                	<div class="col-md-8"><?= $this->Form->input('definition', ['label' => false,'id'=>'definition',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->definition,
                											'rows' => '5', 'cols' => '100',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
					<h4>Modalités de communication sur le projet Pacte</h4>
                	<div class="col-md-8"><?= $this->Form->input('communication', ['label' => false,'id'=>'communication',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->communication,
                											'rows' => '5', 'cols' => '100']); ?>
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
    	if($session->read('Equipe.Engagement') == '0') {
    		echo "<br /><br />";
    		echo $this->Html->link(__('Suite de la démarche'),['controller'=>'projets', 'action'=>'validate'],['class'=>'btn btn-info']);
    	} 
    	?>			
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>
				