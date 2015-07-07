<div class="blocblanc">
	<h2>Administration - Visualisation Outil</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
			<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $enquete->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?><br /><br/>			
			<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?> 
			</div>
			<div class="col-md-8">
				<table cellpadding="0" cellspacing="0" class="table table-striped">
					<tr align='center'>
				    	<td width='40%'><b>Campagne n°</b></td>
				        <td><?= $enquete->campagne ?></td>
					</tr>
				    <tr align='center'>
				    	<td width='40%'><b>Service</b></td>
				        <td><?= $enquete->service ?></td>
					</tr>
				    <tr align='center'>
				    	<td><b>Fonction</b></td>
				        <td><?= $enquete->fonction->name ?></td>
				   	</tr>
				</table>			
				<table cellpadding="0" cellspacing="0" class="table table-striped">
				    <thead>
				        <tr align='center'>
				            <th width='80%'>Question</th>
				            <th width='20%'>Réponses</th>
				        </tr>
				    </thead>
				    <tbody>			
				    <?php foreach ($reponses as $rep): ?>
				    	<tr>
							<td><?= $rep->enquete_question->groupe."".$rep->enquete_question->name?></td>
							<td><?php
							if($rep->enquete_question->id === 10 ) {
								echo $rep->valeur;
							} else {
								switch ($rep->valeur) {
									case 1 :
										echo "Tout à fait d’accord";
										break;
									case 2:
										echo "Plutôt d’accord";
										break;
									case 3 :
										echo "Plutôt pas d’accord";
										break;
									case 4:
										echo "Pas du tout d’accord";
										break;
									case 5 :
										echo "Ne se prononce pas";
										break;
								}
							}
								
							?></td>
						</tr>
					<?php endforeach; ?>
				    </tbody>
				</table>
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
	</div>
</div>   