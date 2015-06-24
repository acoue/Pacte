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
    <table cellpadding="0" cellspacing="0" class="table" >
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
    <table cellpadding="0" cellspacing="0" class="table" >  
        <caption><h5>Constitution de l'équipe</h5></caption>
        <thead>
        	<tr>
            	<th><h5>Prénom</h5></th>
            	<th><h5>Noms</h5></th>
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
	<table cellpadding="0" cellspacing="0" class="table" >  
        <caption><h5>Constitution du comité de pilotage</h5></caption>
        <thead>
        	<tr>
            	<th><h5>Prénom</h5></th>
            	<th><h5>Noms</h5></th>
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
	<table  cellpadding="0" cellspacing="0" class="table" width='80%'>		
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
	<table cellpadding="0" cellspacing="0" class="table" width='80%'>	
		<thead>
			<tr>
				<th width='60%'>Libellé</th>
				<th width='40%'>Date</th>
			</tr>
		<thead>
		<tbody>    
		<?php foreach ($calendriers as $calendrierProjet): ?>
			<tr>
		    	<td><?= $calendrierProjet->libelle ?></td>
	            <td><?= $calendrierProjet->mois." ".$this->Number->format($calendrierProjet->annee) ?></td>			           
		    </tr>
		 <?php endforeach; ?>          
		</tbody>
	</table>
</div>
<div class="blocblanc">
	<h2>Diagnostic</h2>
    <h3>Le projet d'équipe</h3>
    <table  cellpadding="0" cellspacing="0" class="table" width='80%'>		
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
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	    <thead>
	        <tr align='center'>
	            <th width='15%'>Outils</th>
	            <th width='40%'>Votre Synthèse</th>
	        </tr>
	    </thead>
	    <tbody>
	    <?php foreach ($evaluations as $evaluation): ?>
	        <tr>
	            <td><?= h($evaluation->name) ?></td>
	            <td><?= h($evaluation->synthese) ?></td>
	        </tr>
	
	    <?php endforeach; ?>
	    </tbody>
	</table>
</div>
<div class="blocblanc">
	<h2>Mise en Oeuvre</h2>	
	<h3>Objectifs d'amélioration</h3>
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
			echo "<p>Le plan d'action est géré hors Modèle HAS</p>";
		}
	} else {
		echo "<p>Aucun plan d'action n'est définis pour cette démarche</p>";
	}
	?>
	<h3>Evaluation à T0</h3>
		<table cellpadding="0" cellspacing="0" class="table table-striped">
		    <thead>
		        <tr align='center'>
		            <th width='15%'>Outils</th>
		            <th width='40%'>Evolutions des résultats intermédiares / Points forts et axes d'amélioration identifiés</th>
		        </tr>
		    </thead>
		    <tbody>
    		<?php foreach ($mesures as $mesure): ?>
	        <tr>
	            <td><?= h($mesure->name) ?></td>
	            <td><?= h($mesure->resultat) ?></td>
	        </tr>	
	    	<?php endforeach; ?>
	    </tbody>
	</table>			
</div>