<?php 
// debug($etapePlanActions);
// die();
?>

<p align="center">	
	<?= $this->Html->link('Retour', '/pages/home', ['class' => 'btn btn-info']);?>
	<?= $this->Html->link('Générer un PDF', ['controller'=>'Equipes', 'action' => 'visualisation/1/'.$equipe->id],['class' => 'btn btn-default', 'target' => '_blank']) ?>
<?php 
$session = $this->request->session();
if($session->read('Auth.User.role') === 'admin') {

	if($demarche->statut == 0 ) echo "&nbsp;".$this->Html->link('Clôturer la démarche',['controller'=>'Demarches', 'action' => 'cloturerDemarche'],['class' => 'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir clôturer la démarche ?')]);
	else echo "<p align='center' class='alert-mdp-warning'>La demande est clôturée</p>";
} else {
	if($demarche->statut == 1 ) echo "<p align='center' class='alert-mdp-warning'>La demande est clôturée</p>";
}
?>
	</p>
<p align="center"><h1>Récapitulatif des informations : </h1></p>
<div class="blocblanc">
	<br /><h1>&nbsp;&nbsp;<?= $equipe->etablissement->libelle ?> - <?= $equipe->name?></h1><br />
	<h2>Etat de la démarche Pacte</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table cellpadding="0" cellspacing="0" class="table table-striped" width='80%'>
					<thead>
				        <tr align='center'>
							<th width='40%'>Phase</th>
				            <th width='30%'>Date d'entrée</th>
				            <th width='30%'>Date de validation</th>
				        </tr>
				    </thead>
				    <tbody>    
				    <?php foreach ($phases as $phase): ?>
				    	<tr>
							<td><?=$phase->phase->name ?></td>
				            <td><?= date_format($phase->date_entree, 'd/m/Y') ?></td>
				            <td><?php echo (isset($phase->date_validation)) ? date_format($phase->date_validation, 'd/m/Y') : "En cours";  ?></td>
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
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<h4>Mission / Vision / Valeurs de l'équipe</h4>
                	<div class="col-md-12"><?= $this->Form->input('mission', ['label' => false,'id'=>'mission',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->mission,'disabled'=>'disabled',
                											'rows' => '5']); ?>
                    </div>                          
				</div><br /> 		    
				<div class="row">
					<h4>Description de l'équipe</h4>   
					<div class="row">
						<div class="col-md-12">
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
								</tbody>							
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						    <table cellpadding="0" cellspacing="0" class="table table-striped" >  
						        <caption>Constitution de l'équipe</caption>
						        <thead>
						        	<tr>
						            	<th>Prénom</th>
						            	<th>Noms</th>
						            	<th>Fonction</th>
						            	<th>Service</th>
						        	</tr>
						        <thead>
						        <tbody>    
								<?php foreach ($membres as $membre): ?>
									<tr>
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
						        </tbody>
							</table>
						</div>
					</div> 
				</div><br /> 		    
				<div class="row">
					<h4>Lister le ou les secteur(s) d'activité(s) participant au projet Pacte</h4>
                	<div class="col-md-12"><?= $this->Form->input('secteur_activite', ['label' => false,'id'=>'secteur_activite',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->secteur_activite,
                											'rows' => '5','disabled'=>'disabled',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br /> 		    
				<div class="row">
					<h4>Définir le projet d'équipe</h4>
                	<div class="col-md-12"><?= $this->Form->input('definition', ['label' => false,'id'=>'definition',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->definition,
                											'rows' => '5','disabled'=>'disabled',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
					<h4>Modalités de communication sur le projet Pacte</h4>
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
</div>		
<div class="blocblanc">
	<h2>Diagnostic</h2>
	<h3>Le projet d'équipe</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<h4>Intitulé du projet</h4>
                	<div class="col-md-12"><?= $this->Form->input('intitule', ['label' => false,'id'=>'communication',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->intitule,'disabled'=>'disabled',
                											'rows' => '5']); ?>
                    </div>                          
				</div><br />   		    
				<div class="row">
					<h4>Modalité de déploiement</h4>
                	<div class="col-md-12"><?= $this->Form->input('deploiement', ['label' => false,'id'=>'communication',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'textarea', 'escape' => false,
                											'value'=> $projet->deploiement,'disabled'=>'disabled',
                											'rows' => '5']); ?>
                    </div>                          
				</div><br />
				<div class="row">
					<h4>Calendrier de mise en oeuvre</h4>
                	<div class="col-md-12">
                		<table cellpadding="0" cellspacing="0" class="table table-striped" > 
                			<thead>
						    	<tr>
						        	<th width='50%'>Libellé</th>
						        	<th width='40%'>Date début</th>
						        	<th width='40%'>Date fin</th>
						        </tr>
						   	<thead>
						    <tbody>    
							 <?php foreach ($calendriers as $calendrierProjet): ?>
								<tr>
							    	<td><?= $calendrierProjet->libelle ?></td>
						            <td><?= $calendrierProjet->mois_debut." ".$this->Number->format($calendrierProjet->annee_fin) ?></td>	
						            <td><?= $calendrierProjet->mois_debut." ".$this->Number->format($calendrierProjet->annee_fin) ?></td>			           
							    </tr>
							 <?php endforeach; ?>          
							</tbody>
						</table>
                    </div>                          
				</div><br />		
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>	
	<h3>Fonctionnement d'équipe</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='30%'>Outils</th>
				            <th width='50%'>Votre Synthèse</th>
				            <th width='20%'>Fichier</th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($evaluations as $evaluation): ?>
				        <tr>
				            <td><?= h($evaluation->name) ?></td>
				            <td><?= h($evaluation->synthese) ?></td>
				           				            <td>
<?php 
if(h($evaluation->file)) echo $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/userDocument/'.$username.'/'.h($evaluation->file), ['class' => 'titre','target' => '_blank','escape' => false]);
?>
							</td>
				        </tr>
				
				    <?php endforeach; ?>
				    </tbody>
				</table>				
			</div>
			<div class="col-md-1"></div>
		</div>
	</div></div>		
<div class="blocblanc">
	<h2>Mise en Oeuvre</h2>	
	<h3>Pln d'action</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php 
				if($planAction) {
					if($planAction->is_has == 1 ) {    ?> 
						<table cellpadding="0" cellspacing="0" class="table table-striped">
					    <thead>
					        <tr align='center'>
					            <th width='5%'>N°</th>
					            <th width='10%'>Libellé</th>
					            <th width='10%'>Pilote</th>
					            <th width='10%'>Echéance</th>
					            <th width='10%'>Etat</th>
					            <th width='10%'>Indicateur</th>
					            <th width='10%'>Type indicateur</th>
					            <th width='10%'>Modalité de suivi</th>
					            <th width='10%'>Résultat</th>
					        </tr>
					    </thead>
					    <tbody>
	    				<?php foreach ($etapePlanActions as $etapePlanAction): ?>
	    				
					        <tr>
					            <td><?= $this->Number->format($etapePlanAction->numero) ?></td>
	            				<td><?= $etapePlanAction->name ?></td>
	           					<td><?= h($etapePlanAction->pilote) ?></td>
	           					<td><?= h($etapePlanAction->mois)." ".$this->Number->format($etapePlanAction->annee) ?></td>
	            				<td><?= h($etapePlanAction->etat) ?></td>
	            				<td><?= h($etapePlanAction->indicateur) ?></td>
					            <td>
					            <?php
					            //echo $etapePlanAction->has('TypeIndicateur');
					            echo h($etapePlanAction->type_indicateur['name']);
					            ?>
	            
					            </td>
	            				<td><?= h($etapePlanAction->modalite_suivi) ?></td>
	            				<td><?= h($etapePlanAction->resultat) ?></td>				            
					        </tr>
					
					    <?php endforeach; ?>
					    </tbody>
					</table>
					<?php 
					} else {
						echo "<p>Le plan d'action est géré hors Modèle HAS.";
						if(h($planAction->file)) {
							echo "<br />cliquez ici pour l'ouvrir :  ";
							echo $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/userDocument/'.$username.'/'.h($planAction->file), ['class' => 'titre','target' => '_blank','escape' => false]);
						}
						echo "</p>";
						
					}
				} else {
					echo "<p>Aucun plan d'action n'est définis pour cette démarche</p>";
				}
				?>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<h3>Evaluation à T0</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='30%'>Outils</th>
				            <th width='50%'>Evolutions des résultats / Points forts et axes d'amélioration identifiés</th>
				            <th width='20%'>Fichier</th>
				        </tr>
				    </thead>
				    <tbody>
    				<?php foreach ($mesures as $mesure): ?>
				        <tr>
				            <td><?= h($mesure->name) ?></td>
				            <td><?= h($mesure->resultat) ?></td>
				            <td>
<?php 
if(h($mesure->file)) echo $this->Html->link('<span><i class="glyphicon glyphicon-open"></i></span>', '/files/userDocument/'.$username.'/'.h($mesure->file), ['class' => 'titre','target' => '_blank','escape' => false]);
?>
							</td>
				        </tr>
				
				    <?php endforeach; ?>
				    </tbody>
				</table>				
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>

