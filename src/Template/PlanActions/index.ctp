<div class="blocblanc">
<?php 
$session = $this->request->session();
if($session->read('Equipe.Diagnostic') == 0) { ?>	
    <h2>Phase de diagnostic</h2>
<?php } else if($session->read('Equipe.MiseEnOeuvre') == 0) { ?>	
    <h2>Phase de mise en oeuvre</h2>
<?php } else if($session->read('Equipe.Evaluation') == 0) { ?>
    <h2>Phase d'évaluation</h2>
<?php } ?>
    <h3>Plan d'action</h3>
	<div class="blocblancContent">
		<div class="row"> 
			<div class="col-md-1"></div>
			<div class="col-md-11">
			<?= $message->valeur ?>
			</div>
		</div><br />
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				 <div class="row">
				 	<div class="col-md-1"></div>
				 	<div class="col-md-2"><?= $this->Html->image('attention.png', ['height' => '60px', 'title' => 'Programme Pacte']) ?></div>
				 	<div class="col-md-8">blablabla</div>
				 	<div class="col-md-1"></div>
				 </div><br />
			
			
			
			<?php 			
			//Si pas de plan d'action 
			if(empty($planAction)) {
				echo $this->Form->create('planAction', ['id'=>'add_plan_form','action' => 'add']);
				?>					
				<div class="row">			
					<div class="form-group">
						<label class="col-md-4 control-label" >Plan d'action</label>
					  	<div class="col-md-8">
					      	<div class="radio">
					    		<label for="is_has-1">
					      			<input name="is_has" id="is_has" value="1" type="radio" data-location="top" required>
					      			Utiliser le modèle HAS
					    		</label>
					    	</div>
					      	<div class="radio">
					    		<label for="is_has-2">
					      			<input name="is_has" id="is_has" value="0" type="radio" data-location="top">
					      			Utiliser son propre modèle
					    		</label>
							</div>
						
						</div>
					</div>				
				</div><br />
				<p align='center'>					
				<?php
					$session = $this->request->session();
					if($session->read('Equipe.Diagnostic') == '0') {
						echo $this->Html->link(__('Retour'),['controller'=>'Evaluations', 'action'=>'index'],['class'=>'btn btn-info']);
						echo "&nbsp;&nbsp;";
						echo $this->Form->button('Suite', ['type'=>'submit', 'class' => 'btn btn-default']);						
						echo $this->Form->end();
					}?>
				</p>
					
			<?php 
			} else { ?>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
				<?php 
				if($planAction->is_has == 1 ) {
					echo "<p align='center' >Votre plan d'action suit le modèle HAS</p>";
					echo "<div class='row'><div class='col-md-4'></div><div class='col-md-4'>";
					echo $this->Html->link(__('Gestion'),['controller'=>'EtapePlanActions', 'action'=>'index/'.$planAction->id],['class'=>'btn btn-info']);
				} else {
					echo "<p align='center' >Votre Plan d'action suit votre propre modèle</p>";
					echo "<div class='row'><div class='col-md-4'></div><div class='col-md-4'>";
					echo $this->Html->link(__('Gestion'),['controller'=>'PlanActions', 'action'=>'edit/'.$planAction->id],['class'=>'btn btn-info']);
				}
				?>
						<br /><br />
						<?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $planAction->id], ['class'=>'btn btn-warning','confirm' => __('Etes-vous sûr de vouloir supprimer ?')]) ?>
						
							
						<?php
							$session = $this->request->session();
							if($session->read('Equipe.Diagnostic') == '0') {
								echo "<br /><br />";
								echo $this->Html->link(__('Suite'),['controller'=>'Mesures', 'action'=>'index'],['class'=>'btn btn-default']);
							}
						?>

						
						
						</div>
						<div class='col-md-4'></div>
				
					</div>
					<div class="col-md-2"></div>
				</div>				
			<?php 					
			}
			?>
			
				</div>
				<div class="col-md-4"></div>
			</div>
			</div>
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>