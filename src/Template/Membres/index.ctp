<div class="blocblanc">
	<h2>Administration</h2>
<?php 
if($comite === '1') echo "<h3>Membres du comité de pilotage</h3>";
else if ($comite === '0') echo "<h3>Membres de l'équipe</h3>";
else echo "<h3>Membres</h3>";
?>	  
	<div class="blocblancContent">
		<div class="row"> 
			<div class="col-md-1"></div>
			<div class="col-md-11">
				<p>Constituer une équipe, mettre en place et suivre le programme nécessite un accompagnement et un soutien des professionnels engagés. Des capacités de leadership pour assurer la motivation nécessaire pour mener à bien le programme Pacte et en assurer la viabilité dans le temps, nécessite la désignation : 
                	<br /> - <strong>D’un binôme (ou trinôme)</strong> représenté de préférence d’un médecin et d’un cadre de santé
                    <br /> - <strong>D’un facilitateur</strong>, souvent représenté par un coordonnateur de la gestion des risques
                    <br /> - <strong>D’un animateur pour le CRM Santé</strong>, souvent extérieur à l’établissement de santé et à l’équipe
                </p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-9">
            	<table cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
				        <tr align='center'>
				            <th><?= $this->Paginator->sort('prenom') ?></th>
				            <th><?= $this->Paginator->sort('nom') ?></th>
				            <th><?= $this->Paginator->sort('fonction') ?></th>
				            <th><?= $this->Paginator->sort('service') ?></th>
				            <th><?= $this->Paginator->sort('email') ?></th>
				            <th><?= $this->Paginator->sort('telephone') ?></th>
				            <th class="actions"><?= __('Actions') ?></th>
				        </tr>
				    </thead>
				    <tbody>    
				    <?php foreach ($membres as $membre): ?>
				    	<tr>
				            <td><?= h($membre->prenom) ?></td>
				            <td><?= h($membre->nom) ?></td>
				            <td><?= h($membre->fonction->name) ?></td>
				            <td><?= h($membre->service->name) ?></td>
				            <td><?= h($membre->email) ?></td>
				            <td><?= h($membre->telephone) ?></td>
				            <td class="actions">
							<?= $this->Html->link('<span><i class="glyphicon glyphicon-eye-open"></i></span>', ['action' => 'view', $membre->id], array('escape' => false)); ?>&nbsp;&nbsp;
							<?= $this->Html->link('<span><i class="glyphicon glyphicon-edit"></i></span>', ['action' => 'edit', $membre->id], array('escape' => false)); ?>&nbsp;&nbsp;     
							<?= $this->Form->postLink(
				                '<span><i class="glyphicon glyphicon-trash"></i></span>',
				                ['action' => 'delete', $membre->id],
				                ['class' => 'tip', 'escape'   => false, 'confirm'  => 'Etes-vous sûr de supprimer {0} ?']);?>
				            </td>
				        </tr>
				    <?php endforeach; ?>
                 	</tbody>
                 </table>			
			</div>		
			<div class="col-md-1">
				<a data-toggle="modal" data-backdrop="false" data-target="#fenetreModal" class="btn btn-info">Ajouter</a>
			</div>				
			<div class="col-md-1"></div>
		</div>
		<p align="center">
			<?= $this->Html->link(__('Suite'),['#'],['class'=>'btn btn-default']) ?>
		</p>
	</div>
</div>

<!-- Fenetre Modal -->
<div class="modal fade" id="fenetreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
		  		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>  		
<?php 
if($comite === '1') echo "<h4 class='modal-title'>Ajout d'un membre du comité de pilotage</h4>";
else if ($comite === '0') echo "<h4 class='modal-title'>Ajout d'un membre de l'équipe</h4>";
else echo "<h4 class='modal-title'>Ajout d'un membre</h4>";
?>			
			</div>
			<div class="modal-body">
			<?= $this->Form->create('membre', ['id'=>'add_membre_form','action' => 'add']); ?>  
			<?= $this->Form->hidden('comite',['value' => $comite]);?>		    
				<div class="row">
                	<label class="col-md-4 control-label" for="responsabilite_id">Type de membres <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('responsabilite_id', ['label' => false,'id'=>'responsabilite_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										['options' => $responsabilites],
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Nom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('nom', ['label' => false,'id'=>'nom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="nom">Prénom <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('prenom', ['label' => false,'id'=>'prenom',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="fonction_id">Fonction <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('fonction_id', ['label' => false,'id'=>'fonction_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										['options' => $fonctions],
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />  		    
				<div class="row">
                	<label class="col-md-4 control-label" for="service_id">Service <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('service_id', ['label' => false,'id'=>'service_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										['options' => $services],
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="email">Adresse Email <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('email', ['label' => false,'id'=>'email',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'data-location' => 'bottom',
                    										'data-validation'=>'email',
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />      
				<div class="row">
                	<label class="col-md-4 control-label" for="telephone">Ligne directe  <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('telephone', ['label' => false,'id'=>'telephone',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text', 
                    										'required' =>'required']); ?>
                    </div>                          
				</div><br />	
			  	<p align='left'><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>    		
			</div>
			<div class="modal-footer">
				<?= $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
		    	<?= $this->Form->end() ?>
		  		<button data-dismiss="modal" class="btn btn-info" type="button">Fermer</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->