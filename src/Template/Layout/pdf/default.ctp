<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'bootstrap.css'?>" >
<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'style.css'?>">
<table width="100%" border="0" >
	<tr width="10%">
		<td rowspan='2'><img src='<?= WWW_ROOT.'img'.DS .'logo.jpg' ?>'/></td>
		<td><h3>Récapitulatif des informations de votre phase d'engagement</h3></td>
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
				<td><h5><?php if($rep['libelle'] == 'N') echo "Non"; else echo 'Oui'; ?></h5></td>
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
    <h4>Description de l'équipe</h4>
    <table cellpadding="0" cellspacing="0" class="table" >
		<thead>
			<tr>
    	       	<th><h5>Fonction</h5></th>
	           	<th><h5>Nombre d'ETP</h5></th>
	           	<th><h5>Service</h5></th>
	       	</tr>
		</thead>
		<tbody>	
		<?php foreach ($descriptions as $description): ?>
    		<tr>
    			<td><h5><?= h($description->fonction->name) ?></h5></td>
            	<td><h5><?= h($description->nb_etp) ?></h5></td>
            	<td><h5><?= h($description->service) ?></h5></td>
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
	</table>
</div>