<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'bootstrap.css'?>" >
<link rel="stylesheet" type="text/css" href="<?= WWW_ROOT.'css'.DS .'style.css'?>">
<table width="100%" border="0" >
	<tr width="10%">
		<td rowspan='2'><img src='<?= WWW_ROOT.'img'.DS .'logo.jpg' ?>'/></td>
		<?php 
		$session = $this->request->session();
		?>
		<td><h3>Récapitulatif des informations : <?= $session->read('Equipe.Libelle_Etablissement') ?> - Equipe <?= $session->read('Equipe.Libelle') ?></h3></td>
	</tr>
	<tr>
		<td><p><h5>Date d'édition : <?= date('d/m/Y à H:i:s')?></h5></p></td>
	</tr>
</table>
<br /><br />
<div class="blocblanc">
	<h2>Mise en Oeuvre</h2>	
	<h3>Objectifs d'amélioration</h3>
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
		
</div>