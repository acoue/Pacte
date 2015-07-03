<div class="blocblanc">
	<h2>Fiche d'engagement de l'équipe</h2>
    <h3>Le projet Pacte</h3>    
	<h4>Macro-Planning</h4>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row"> 
					<div class="col-md-1"></div>
					<div class="col-md-11">
					<?= $message->valeur ?>
					</div>
				</div><br />
				<div class="row">				
					<div class="col-md-10">
						<table cellpadding="0" cellspacing="0" class="table table-striped" >
							<caption>Calendrier de mise en oeuvre</caption>
						    <thead>
						        <tr>
						            <th width='40%'>Libellé</th>
						            <th width='20%'>Date de début</th>
						            <th width='20%'>Date de fin</th>
						            <th class="actions"><?= __('Actions') ?></th>
						        </tr>
						    </thead>
						    <tbody>
						    <?php foreach ($calendriers as $calendrierProjet): ?>
						        <tr>            
						            <td><?= $calendrierProjet->libelle ?></td>
						            <td><?= $calendrierProjet->mois_debut." ".$this->Number->format($calendrierProjet->annee_debut) ?></td>	
						            <td><?= $calendrierProjet->mois_fin." ".$this->Number->format($calendrierProjet->annee_fin) ?></td>						            
						            <td class="actions">
						            <?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['controller'=>'CalendrierProjets','action' => 'edit', $calendrierProjet->id], ['title'=>'Editer','escape' => false]); ?>&nbsp;&nbsp;     
									<?= $this->Form->postLink('<span><i class="glyphicon glyphicon-trash"></i></span>',
							                ['controller'=>'CalendrierProjets','action' => 'delete', $calendrierProjet->id],
							                ['class' => 'tip', 'title'=>'Supprimer','escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer ?']);?>
							    	</td>
						        </tr>
						
						    <?php endforeach; ?>
						    </tbody>
					    </table>
					</div>
					<div class="col-md-2">
						<?= $this->Html->link(__('Ajouter'),['controller'=>'CalendrierProjets', 'action'=>'add/'.$projet->id],
						['class'=>'btn btn-info']);?>
					</div>
				</div>
			</div>						
			<div class="col-md-1"></div>
		</div>
	<p align="center">  
	<?php 
    	//Si toujours en phase d'engagement
    	$session = $this->request->session();
    	if($session->read('Equipe.Engagement') == '0') {
    		echo $this->Html->link(__('Retour'),['controller'=>'projets', 'action'=>'index'],['class'=>'btn btn-info']);
    		echo "&nbsp;&nbsp;";
    		echo $this->Html->link(__('Terminer la phase d\'engagement'),['controller'=>'projets', 'action'=>'validate'],['class'=>'btn btn-default']);
    	}
    ?>			
	</p>	
	</div>
</div>	
