<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'bootstrap.css'?>" >
<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'style.css'?>">
<table width="100%" border="0" >
	<tr width="10%">
		<td rowspan='2'><img src='<?= WWW_ROOT.'img'.DS .'logo.jpg' ?>'/></td>
		<td><h3>Récapitulatif des informations : <?= $equipe->etablissement->libelle ?> - Equipe <?= $equipe->name?></h3></td>
	</tr>
	<tr>
		<td><p><h5>Date d'édition : <?= date('d/m/Y à H:i:s')?></h5></p></td>
	</tr>
</table>
<br /><br />
<div class="blocblanc">
	<h2>Dossier d'engagement d'une équipe</h2><br />
	<table  cellpadding="0" cellspacing="0" class="table" width='80%'>
		<tr>
			<td width='30%'><h5>Date d'engagement : </h5></td>
			<td><h5><?= date_format($demarche->date_engagement, 'd/m/Y') ?></h5></td>
		</tr>
		<tr>
			<td width='30%'><h5>Numéro de démarche : </h5></td>
			<td><h5><?= $equipe->etablissement->numero_demarche ?></h5></td>
		</tr>
		<tr>
			<td width='30%'><h5>Etablissement de santé : </h5></td>
			<td><h5><?= $equipe->etablissement->libelle ?></h5></td>
		</tr>
		<tr>
			<td width='30%'><h5>Numéro FINESS : </h5></td>
			<td><h5><?= $equipe->etablissement->finess ?></h5></td>
		</tr>
	</table>
</div>
<div class="blocblanc">
	<h2>Dossier d'engagement de la Direction</h2><br />
	<table  cellpadding="0" cellspacing="0" class="table" width='80%'>
		<tr>
			<td width='30%'><h5>Niveau de certification : </h5></td>
			<td><h5><?= $equipe->etablissement->niveau_certification ?></h5></td>
		</tr>
		<tr>
			<td width='30%'><h5>Score obtenu : </h5></td>
			<td><h5><?= $demarche->score ?></h5></td>
		</tr>
	</table>
	<table  cellpadding="0" cellspacing="0" class="table" width='100%'>
	<?php
		$i=0;
		foreach ($reponses as $rep) {?>
			<tr>
				<td width='90%'><h5><?= $rep['question']['texte']  ?></h5></td>
				<td><h5><?= ($rep['libelle'] == 'N') ? "Non" : 'Oui'; ?></h5></td>
			</tr>
		<?php } ?>
	</table>	
</div>
<div class="blocblanc">
	<h2>Dossier d'engagement de l'équipe</h2>
	<h3>Membres référents de l'équipe</h3>	
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
		<thead>
	        <tr align='center'>
				<th width='15%'><h5>Rôle</h5></th>
	            <th><h5>Prénom</h5></th>
	            <th><h5>Nom</h5></th>
	            <th><h5>Fonction</h5></th>
	            <th><h5>Service</h5></th>
	        </tr>
	    </thead>
	    <tbody>    
	    <?php foreach ($membres_referents as $referent): ?>
	    	<tr>
				<td><h5><?= h($referent->responsabilite->name) ?></h5></td>
	            <td><h5><?= h($referent->prenom) ?></h5></td>
	            <td><h5><?= h($referent->nom) ?></h5></td>
	            <td><h5><?= h($referent->fonction) ?></h5></td>
	            <td><h5><?= h($referent->service) ?></h5></td>
	        </tr>
	    <?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="blocblanc">
	<h2>Fiche d'engagement de l'équipe</h2>
    <h3>Le projet Pacte</h3>    
	<table  cellpadding="0" cellspacing="0" class="table" width='80%'>		
		<tr>
			<td><h4>Mission / Vision / Valeurs de l'équipe</h4></td>
		</tr>
		<tr>
			<td><h5><?= $projet->mission ?></h5></td>
		</tr>
	</table>
	<br /><br />
    <h4>Présentation de l'équipe</h4>
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
		<thead>
			<tr>
    	       	<th><h5>Fonction</h5></th>
	           	<th><h5>Nombre d'ETP</h5></th>
	       	</tr>
		</thead>
		<tbody>	
		<?php foreach ($descriptions as $description): ?>
    		<tr>
    			<td><h5><?= h($description->fonction->name) ?></h5></td>
            	<td><h5><?= h($description->nb_etp) ?></h5></td>
	    	</tr>						    
    	<?php endforeach; ?>							
		</tbody>							
	</table><br /><br />
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
        <caption><h5>Constitution de l'équipe</h5></caption>
        <thead>
        	<tr>
            	<th><h5>Prénom</h5></th>
            	<th><h5>Nom</h5></th>
            	<th><h5>Fonction</h5></th>
            	<th><h5>Service</h5></th>
        	</tr>
        <thead>
        <tbody>    
		<?php foreach ($membres as $membre): ?>
			<tr>
	            <td><h5><?= h($membre->prenom) ?></h5></td>
	            <td><h5><?= h($membre->nom) ?></h5></td>
	            <td><h5><?= h($membre->fonction) ?></h5></td>
	            <td><h5><?= h($membre->service) ?></h5></td>			            
	        </tr>
	    <?php endforeach; ?>  
        </tbody>
	</table><br /><br />
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
        <caption><h5>Constitution du comité de pilotage</h5></caption>
        <thead>
        	<tr>
            	<th><h5>Prénom</h5></th>
            	<th><h5>Nom</h5></th>
            	<th><h5>Fonction</h5></th>
            	<th><h5>Service</h5></th>
        	</tr>
        <thead>
        <tbody>    
		<?php foreach ($membres_comites as $comite): ?>
			<tr>
	            <td><h5><?= h($comite->prenom) ?></h5></td>
	            <td><h5><?= h($comite->nom) ?></h5></td>
	            <td><h5><?= h($comite->fonction) ?></h5></td>
	            <td><h5><?= h($comite->service) ?></h5></td>			           
	        </tr>
	    <?php endforeach; ?>          
        </tbody>
	</table><br /><br />		
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>	
		<tr>
			<td><h4>Lister le ou les secteur(s) d'activité(s) participant au projet Pacte</h4></td>
		</tr>
		<tr>
			<td><h5><?= $projet->secteur_activite ?></h5></td>
		</tr>		
		<tr>
			<td><h4>Définir le projet d'équipe</h4></td>
		</tr>
		<tr>
			<td><h5><?= $projet->definition ?></h5></td>
		</tr>		
		<tr>
			<td><h4>Modalités de communication sur le projet Pacte</h4></td>
		</tr>
		<tr>
			<td><h5><?= $projet->communication ?></h5></td>
		</tr>
	</table><br /><br />
	<h4>Calendrier de mise en oeuvre</h4>
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
		<thead>
			<tr>
				<th width='40%'><h5>Libellé</h5></th>
				<th width='30%'><h5>Date</h5></th>
				<th width='30%'><h5>Date</h5></th>
			</tr>
		<thead>
		<tbody>    
		<?php foreach ($calendriers as $calendrierProjet): ?>
			<tr>
		    	<td><h5><?= $calendrierProjet->libelle ?></h5></td>
	            <td><h5><?= $calendrierProjet->mois_debut." ".$this->Number->format($calendrierProjet->annee_debut) ?></h5></td>		
	            <td><h5><?= $calendrierProjet->mois_fin." ".$this->Number->format($calendrierProjet->annee_fin) ?></h5></td>		           
		    </tr>
		 <?php endforeach; ?>          
		</tbody>
	</table>
</div>
<div class="blocblanc">
	<h2>Diagnostic</h2>
    <h3>Le projet d'équipe</h3>
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>	
		<tr>
			<td><h4>Intitulé du projet</h4></td>
		</tr>
		<tr>
			<td><h5><?= $projet->intitule ?></h5></td>
		</tr>		
		<tr>
			<td><h4>Modalité de déploiement</h4></td>
		</tr>
		<tr>
			<td><h5><?= $projet->deploiement ?></h5></td>
		</tr>
	</table>   	
	<h3>Fonctionnement d'équipe</h3>
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
	    <thead>
	        <tr align='center'>
	            <th width='15%'><h5>Outils</h5></th>
	            <th width='40%'><h5>Votre Synthèse</h5></th>
	        </tr>
	    </thead>
	    <tbody>
	    <?php foreach ($evaluations as $evaluation): ?>
	        <tr>
	            <td><h5><?= h($evaluation->name) ?></h5></td>
	            <td><h5><?= h($evaluation->synthese) ?></h5></td>
	        </tr>
	
	    <?php endforeach; ?>
	    </tbody>
	</table>
</div>
<div class="blocblanc">
	<h2>Mise en Oeuvre</h2>	
	<h3>Plan d'action</h3>
	<?php 
	if($planAction) {
		if($planAction->is_has == 1 ) {    ?> 
			<table cellpadding="0" cellspacing="0" class="table" width='100%'>
			    <thead>
			        <tr align='center'>
			            <th width='5%'><h5>N°</h5></th>
			            <th width='15%'><h5>Libellé</h5></th>
			            <th width='10%'><h5>Pilote</h5></th>
			            <th width='10%'><h5>Echéance</h5></th>
			            <th width='10%'><h5>Etat</h5></th>
			            <th width='10%'><h5>Indicateur</h5></th>
			            <th width='10%'><h5>Type indicateur</h5></th>
			            <th width='15%'><h5>Modalité de suivi</h5></th>
			            <th width='15%'><h5>Résultat</h5></th>
			        </tr>
			    </thead>
			    <tbody>
    				<?php foreach ($etapePlanActions as $etapePlanAction): ?>
    				
			        <tr>
			            <td><h5><?= $this->Number->format($etapePlanAction->numero) ?></h5></td>
            			<td><h5><?= $etapePlanAction->name ?></h5></td>
           				<td><h5><?= h($etapePlanAction->pilote) ?></h5></td>
           				<td><h5><?= h($etapePlanAction->mois)." ".$this->Number->format($etapePlanAction->annee) ?></h5></td>
            			<td><h5><?= h($etapePlanAction->etat) ?></h5></td>
            			<td><h5><?= h($etapePlanAction->indicateur) ?></h5></td>
	            		<td><h5><?= h($etapePlanAction->type_indicateur['name']) ?></h5></td>
            			<td><h5><?= h($etapePlanAction->modalite_suivi) ?></h5></td>
            			<td><h5><?= h($etapePlanAction->resultat) ?></h5></td>				            
		        	</tr>
		
		    	<?php endforeach; ?>
		    	</tbody>
			</table>
		<?php 
		} else {
			echo "<p>Le plan d'action est géré hors Modèle HAS</p><br /><br />";
		}
	} else {
		echo "<p>Aucun plan d'action n'est défini pour cette démarche</p><br /><br />";
	}
	?>
	<h3>Evaluation</h3>
	<table cellpadding="0" cellspacing="0" class="table" width='100%'>
		<thead>
	       <tr align='center'>
		       	<th width='35%'><h5>Outils</h5></th>
	    		<th width='65%'><h5>Evolutions des résultats / Points forts et axes d'amélioration identifiés</h5></th>
		   	</tr>
		</thead>
		<tbody>
    	<?php foreach ($mesures as $mesure): ?>
	     	<tr>
	            <td><h5><?= h($mesure->name) ?></h5></td>
	            <td><h5><?= h($mesure->resultat) ?></h5></td>
	        </tr>	
	    <?php endforeach; ?>
	    </tbody>
	</table>			
</div>