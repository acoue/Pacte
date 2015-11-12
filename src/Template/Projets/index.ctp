<div class="blocblanc">
	<h2>Fiche d'engagement de l'équipe</h2>
    <h3>Le projet Pacte</h3>    
	<h4>Présentation de l'équipe</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">     		    
				<div class="row">   
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<p><?= $messageDescription->valeur ?></p><br />
							<table cellpadding="0" cellspacing="0" class="table table-striped" >
								<thead>
									<tr>
					    	        	<th width='50%' >Fonction</th>
						            	<th width='30%'>Nombre d'ETP</th>
				           				<th width='20%' class="actions"><?= __('Actions') ?></th>
						        	</tr>
								</thead>
								<tbody>	
							    	<?php foreach ($descriptions as $description): ?>
							    	<tr>
							    		<td><?= h($description->fonction->name) ?></td>
			            				<td><?= h($description->nb_etp) ?></td>
							            <td class="actions"><?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['controller'=>'descriptions','action' => 'edit', $description->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
											<?= $this->Form->postLink(
								                '<span><i class="glyphicon glyphicon-trash"></i></span>',
								                ['controller'=>'descriptions','action' => 'delete', $description->id],
								                ['class' => 'tip','title'=>'Supprimer', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer la description pour cette fonction?']);?>
							          </td>
							    	</tr>						    
						    		<?php endforeach; ?>								  
							    	<tr>
							    		<td colspan='3' align='center'>							    		
							    		<?= $this->Html->link(__('Ajouter une fonction'), ['controller'=>'descriptions','action' => 'add/'.$projet->id], ['class'=>'btn btn-default']) ?>			
										</td>
							    	</tr> 							
								</tbody>							
							</table>
						</div>
						<div class="col-md-1"></div>
					</div>		
					<div class="row">
						<!--  <p><span class="text-muted">Liste détaillées de l'équipe (liste nominative)</span>  -->              	
                	
						</p>
						<div class="col-md-12">
						    <table cellpadding="0" cellspacing="0" class="table table-striped" >  
						        <caption>Constitution de l'équipe (Liste nominative ci-dessous)</caption>
						        <thead>
						        	<tr>
						        		<th width='15%'>Rôle</th>
						            	<th width='20%'>Prénom</th>
						            	<th width='20%'>Nom</th>
						            	<th width='15%'>Fonction</th>
						            	<th width='15%'>Service</th>
				            			<th width='15%' class="actions"><?= __('Actions') ?></th>
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
							            <td class="actions">
										<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['controller'=>'membres','action' => 'view/'.$membre->id.'/0/0/projet'], ['title'=>'Visualiser','escape' => false]); ?>&nbsp;&nbsp;
										<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['controller'=>'membres','action' => 'edit/'.$membre->id.'/0/0/projet'],  ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
										<?= $this->Form->postLink(
							                '<span><i class="glyphicon glyphicon-trash"></i></span>',
							                ['controller'=>'membres','action' => 'delete/'.$membre->id.'/0/0/projet'],
							                ['class' => 'tip',  'title'=>'Supprimer','escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer le membre ?']);?>
							            </td>		            
							        </tr>
							    <?php endforeach; ?>  
							    	<tr>
							    		<td colspan='6' align='center'>
							    		<?= $this->Html->link(__('Ajouter un membre'), ['controller'=>'membres','action' => 'add/0/0'], ['class'=>'btn btn-default']) ?>			
										</td>
							    	</tr>      
						        </tbody>
						        </table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						    <table cellpadding="0" cellspacing="0" class="table table-striped" >  
						        <caption>Constitution du comité de pilotage</caption>
						        <thead>
						        	<tr>
						            	<th width='20%'>Prénom</th>
						            	<th width='25%'>Noms</th>
						            	<th width='20%'>Fonction</th>
						            	<th width='20%'>Service</th>
				            			<th width='15%' class="actions"><?= __('Actions') ?></th>
						        	</tr>
						        <thead>
						        <tbody>    
								<?php foreach ($membres_comites as $comite): ?>
									<tr>
							            <td><?= h($comite->prenom) ?></td>
							            <td><?= h($comite->nom) ?></td>
							            <td><?= h($comite->fonction) ?></td>
							            <td><?= h($comite->service) ?></td>		
							            <td class="actions">
										<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['controller'=>'membres','action' => 'view/'.$comite->id.'/1/0/projet'],  ['title'=>'Visualiser','escape' => false]); ?>&nbsp;&nbsp;
										<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['controller'=>'membres','action' => 'edit/'.$comite->id.'/1/0/projet'],  ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
										<?= $this->Form->postLink(
							                '<span><i class="glyphicon glyphicon-trash"></i></span>',
							                ['controller'=>'membres','action' => 'delete/'.$comite->id.'/1/0/projet'],
							                ['class' => 'tip',  'title'=>'Supprimer','escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer le membre ?']);?>
							            </td>		      		           
							        </tr>
							    <?php endforeach; ?>    
							    	<tr>
							    		<td colspan='5' align='center'>
							    		<?= $this->Html->link(__('Ajouter un membre du comité de pilotage'), ['controller'=>'membres','action' => 'add/1/0'], ['class'=>'btn btn-default']) ?>			
										</td>
							    	</tr>        
						        </tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div> 
		</div>
	</div>
	<h4>Mission / Vision / Valeurs de l'équipe</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 					
				<?php 
		    		//Si toujours en phase d'engagement => Formulaire
		    		$session = $this->request->session();
		    		if($session->read('Equipe.Engagement') == '1') echo $this->Form->create($projet,['id'=>'edit_projet_form','action'=>'validate']);
		    		else echo $this->Form->create($projet,['id'=>'edit_projet_form','action'=>'calendrier']);
		    	?>
    			<?= $this->Form->hidden('id',['value' => $projet->id]);?>		    
				<div class="row">					
					<p><?= $messageMission->valeur ?></p>
                	<div class="col-md-12"><?= $this->Form->input('mission', ['label' => false,'id'=>'mission',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->mission,
                											'rows' => '5']); ?>
                    </div>                          
				</div>
			</div>
			<div class="col-md-1"></div>
		</div> 
	</div>
	<h4>Lister le ou les secteur(s) d'activité(s) participant au projet Pacte <span class="obligatoire"><sup> *</sup></span></h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">	
					<p><?= $messageSecteur->valeur ?></p>				
                	<div class="col-md-12"><?= $this->Form->input('secteur_activite', ['label' => false,'id'=>'secteur_activite',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->secteur_activite,
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div>
			</div>
			<div class="col-md-1"></div>
		</div> 
	</div>
	<h4>Définir le projet d'équipe <span class="obligatoire"><sup> *</sup></span></h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">		
					<p><?= $messageProjet->valeur ?></p>			
                	<div class="col-md-12"><?= $this->Form->input('definition', ['label' => false,'id'=>'definition',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->definition,
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div>
			</div>
			<div class="col-md-1"></div>
		</div> 
	</div>
	<h4>Modalités de communication sur le projet Pacte</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">				    
				<div class="row">			
					<p><?= $messageCommunication->valeur ?></p>			
                	<div class="col-md-12"><?= $this->Form->input('communication', ['label' => false,'id'=>'communication',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->communication,
                											'rows' => '5']); ?>
                    </div>                          
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div><br /><br />
		<p align="center">
		<?php 
    		//Si toujours en phase d'engagement
    		$session = $this->request->session();
    		if($session->read('Equipe.Engagement') == '0') {
				echo $this->Form->button('Suite de la démarche', ['type'=>'submit', 'class' => 'btn btn-default']);	
		
    		} else {
    			echo $this->Form->button('Enregistrer', ['type'=>'submit', 'class' => 'btn btn-default']);
    		}
			echo $this->Form->end() 
			
			
		?>
		</p>
		<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>		