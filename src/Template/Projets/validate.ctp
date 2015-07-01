<p align='center'><h1>Récapitulatif des informations de votre phase d'engagement</h1></p>
<div class="blocblanc">
	<h2>Dossier d'engagement d'une équipe Pacte</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<label class="col-md-4 control-label" for="date">Date d'engagement</label>
					<div class="col-md-4"><?= $this->Form->input('date', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                											'value'=> date_format($demarche->date_engagement, 'd/m/Y'),  
	                											'disabled'=>'disabled']); ?>
					</div>
				</div><br />
				<div class="row">
				
					<label class="col-md-4 control-label" for="num_demarche">Numéro de démarche</label>
					<div class="col-md-4"><?= $this->Form->input('num_demarche', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                											'value'=> $equipe->etablissement->numero_demarche,
	                											'disabled'=>'disabled']); ?>
					</div>
				</div><br />
				<div class="row">
				
					<label class="col-md-4 control-label" for="etablissement">Etablissement de santé </label>
					<div class="col-md-6"><?= $this->Form->input('etablissement', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                											'value'=> $equipe->etablissement->libelle,
	                											'disabled'=>'disabled']); ?>
					</div>
				</div><br />
				<div class="row">
				
					<label class="col-md-4 control-label" for="finess">Numéro FINESS </label>
					<div class="col-md-4"><?= $this->Form->input('finess', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                											'value'=> $equipe->etablissement->finess,
	                											'disabled'=>'disabled']); ?>
					</div>
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>

<div class="blocblanc">
	<h2>Dossier d'engagement de la Direction</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<label class="col-md-4 control-label" for="niveau_certification">Niveau de certification </label>
					<div class="col-md-6"><?= $this->Form->input('niveau_certification', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                											'value'=> $equipe->etablissement->niveau_certification,
	                											'disabled'=>'disabled']); ?>
					</div>
				</div><br />
				<div class="row">
					<label class="col-md-4 control-label" for="score">Score obtenu </label>
					<div class="col-md-4"><?= $this->Form->input('score', ['label' => false,
															   	'div' => false,
																'class' => 'form-control', 
	                    										'type' => 'text',
	                											'value'=> $demarche->score,
	                											'disabled'=>'disabled']); ?>
					</div>
				</div><br />
				<div class="row">
					<?php 
					$i=0;
					foreach ($reponses as $rep) { 
						$i++;
						($rep['libelle'] == 'N') ? $repLib = "Non" : $repLib = 'Oui' ;?>
						<label class="col-md-10 control-label"><?= $rep['question']['texte'] ?></label>
						<div class="col-md-2 control-label"><?= $this->Form->input('q'.$i, ['label' => false,
																	   	'div' => false,
																		'class' => 'form-control', 
			                    										'type' => 'text',
			                											'value'=> $repLib,
			                											'disabled'=>'disabled']); ?>
						</div><br />
					<?php } ?>
					
				</div>			
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>

<div class="blocblanc">
	<h2>Dossier d'engagement de l'équipe</h2>
	<h3>Membres référents de l'équipe</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
            	<table cellpadding="0" cellspacing="0" class="table table-striped" width='100%'>
					<thead>
				        <tr align='center'>
							<th width='15%'>Rôle</th>
				            <th><?= $this->Paginator->sort('prenom','Prénom') ?></th>
				            <th><?= $this->Paginator->sort('nom') ?></th>
				            <th><?= $this->Paginator->sort('fonction') ?></th>
				            <th><?= $this->Paginator->sort('service') ?></th>
				        </tr>
				    </thead>
				    <tbody>    
				    <?php foreach ($membres_referents as $referent): ?>
				    	<tr>
							<td><?=h($referent->responsabilite->name) ?></td>
				            <td><?= h($referent->prenom) ?></td>
				            <td><?= h($referent->nom) ?></td>
				            <td><?= h($referent->fonction) ?></td>
				            <td><?= h($referent->service) ?></td>
				        </tr>
				    <?php endforeach; ?>
                 	</tbody>
                 </table>			
			</div>			
			<div class="col-md-1"></div>
		</div>

	
	</div>
</div>






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
							<table cellpadding="0" cellspacing="0" class="table table-striped" >
								<thead>
									<tr>
					    	        	<th width='50%' >Fonction</th>
						            	<th width='30%'>Nombre d'ETP</th>
						        	</tr>
								</thead>
								<tbody>	
							    	<?php foreach ($descriptions as $description): ?>
							    	<tr>
							    		<td><?= h($description->fonction->name) ?></td>
			            				<td><?= h($description->nb_etp) ?></td>							            
							    	</tr>						    
						    		<?php endforeach; ?>  
								</tbody>							
							</table>
						</div>
						<div class="col-md-1"></div>
					</div>		
					<div class="row">
						<div class="col-md-12">
						    <table cellpadding="0" cellspacing="0" class="table table-striped" >  
						        <caption>Constitution de l'équipe</caption>
						        <thead>
						        	<tr>
						        		<th width='15%'>Rôle</th>
						            	<th width='20%'>Prénom</th>
						            	<th width='20%'>Noms</th>
						            	<th width='15%'>Fonction</th>
						            	<th width='15%'>Service</th>
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
				<div class="row">
					
					<p>Quelle est votre raison d’être (mission) ? Qu’est-ce qui est important pour votre équipe (valeurs) ?<br/>
					Quelles sont vos perspectives (vision) ?</p>
                	<div class="col-md-12"><?= $this->Form->input('mission', ['label' => false,'id'=>'mission',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->mission,'disabled'=>'disabled',
                											'rows' => '5']); ?>
                    </div>                          
				</div>
			</div>
			<div class="col-md-1"></div>
		</div> 
	</div>
	<h4>Lister le ou les secteur(s) d'activité(s) participant au projet Pacte</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">					
                	<div class="col-md-12"><?= $this->Form->input('secteur_activite', ['label' => false,'id'=>'secteur_activite',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->secteur_activite,'disabled'=>'disabled',
                											'rows' => '5', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div>
			</div>
			<div class="col-md-1"></div>
		</div> 
	</div>
	<h4>Définir le projet d'équipe</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">					
                	<div class="col-md-12"><?= $this->Form->input('definition', ['label' => false,'id'=>'definition',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->definition,'disabled'=>'disabled',
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
                	<div class="col-md-12"><?= $this->Form->input('communication', ['label' => false,'id'=>'communication',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->communication,'disabled'=>'disabled',
                											'rows' => '5']); ?>
                    </div>                          
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div>
	</div>
	<h4>Macro-Planning</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"> 
				<div class="row">
					<table cellpadding="0" cellspacing="0" class="table table-striped" >
					    <thead>
					        <tr>
					            <th width='60%'>Libellé</th>
					            <th width='20%'>Date début</th>
					            <th width='20%'>Date fin</th>
					        </tr>
					    </thead>
					    <tbody>
					    <?php foreach ($calendriers as $calendrierProjet): ?>
					        <tr>            
					            <td><?= $calendrierProjet->libelle ?></td>
					            <td><?= $calendrierProjet->mois_debut." ".$this->Number->format($calendrierProjet->annee_debut) ?></td>
					            <td><?= $calendrierProjet->mois_fin." ".$this->Number->format($calendrierProjet->annee_fin) ?></td>
					        </tr>					
					    <?php endforeach; ?>
					    </tbody>
				    </table>
				</div><br />
				<div class="row">
		        	<p align="center">La validation des renseignement ci-dessus, entrainement l'entrée dans votre démarche d'accréditation.<br/>
		                Suite à cette validation, vous recevrez un e-mail récapitulatif des informations.
		            </p>
<?php 
	$session = $this->request->session();
    if($session->read('Equipe.Engagement') == '0') { 
    	//Formulaire => numero de demarche
    	echo $this->Form->create($projet,['action'=>'validate']);
    	
    	
    	
    	
    	echo "<p align='center'>";
		echo $this->Html->link(__('Retour'),['controller'=>'projets', 'action'=>'index'],['class'=>'btn btn-info']);
		echo "&nbsp;&nbsp;&nbsp;";
    	echo $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']);
		echo "</p>";
		echo $this->Form->end(); 
 } ?>
    			</div>
			</div>
			<div class="col-md-1"></div>
		</div> 
	</div>
</div>	