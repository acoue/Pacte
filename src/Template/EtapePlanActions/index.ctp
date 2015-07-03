
<div class="blocblanc">
	<h2>Phase de diagnostic</h2>
    <h3>Objectifs d'amélioration - Modèle HAS</h3>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-12"> 
				<div class="row"> 
					<div class="col-md-1"></div>
					<div class="col-md-11">
					<?= $message->valeur ?>
					</div>
				</div><br />
				<div class="row"> 
					<div class="col-md-12">
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
						            <th  width='15%' class="actions"><?= __('Actions') ?></th>
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
						            <td class="actions">
									<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $etapePlanAction->id], ['escape' => false,'title'=>'Editer']); ?>&nbsp;&nbsp;     
									<?= $this->Form->postLink(
									                '<span><i class="glyphicon glyphicon-trash"></i></span>',
									                ['action' => 'delete', $etapePlanAction->id],
									                ['class' => 'tip', 'escape'   => false, 'title'=>'Supprimer','confirm'  => 'Etes-vous sûr de supprimer ?']);?>
						          </td>
						        </tr>
						
						    <?php endforeach; ?>
						    </tbody>
						</table>
					</div>
				</div><br />	
				<p align="center">			
					<?= $this->Html->link(__('Ajouter un objectif'),['action'=>'add'],['class'=>'btn btn-info'])?>						
				</p>
				<p align="center">
					<?= $this->Html->link(__('Supprimer le plan d\'action'), ['controller'=>'PlanActions','action' => 'delete', $plan], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?>
					<?php
			$session = $this->request->session();
			if($session->read('Equipe.Diagnostic') == '0') {
				echo "<br /><br />";
				echo $this->Html->link('Retour', ['controller'=>'evaluations','action' => 'index'], ['class' => 'btn btn-info']);
				echo "&nbsp;&nbsp;";
				echo $this->Html->link('Suite', ['controller'=>'mesures','action' => 'index'], ['class' => 'btn btn-default']);
			}
			?>
				
				
				</p>
			</div>
		</div>
	</div>
</div>