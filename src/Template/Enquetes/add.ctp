<div class="blocblanc">
	<h2>Phase de mise en oeuvre</h2>
    <h3>Enquête de satisfaction : Questionnaire individuel et anonyme</h3>
	<div class="blocblancContent">
	
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p><?= $message->valeur ?></p>		
			</div>
			<div class="col-md-1"></div>
		</div>	<br />
		<div class="row">
			<div class="col-md-1"></div>
    		<?= $this->Form->create($enquete, ['id'=>'add_enquete_reponse_form']); ?>
    		<?= $this->Form->hidden('demarche_id',['value' => $id_demarche]);?>		    
			<div class="col-md-10">
			<?php $numCamp = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6']?>
				<div class="row">
                	<label class="col-md-4 control-label" for="campagne">Campagne n° <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('campagne', ['label' => false,'id'=>'campagne',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options' => $numCamp]); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="service">Service <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('service', ['label' => false,'id'=>'service',
														   	'div' => false,
															'class' => 'form-control', 
                    										'type' => 'text']); ?>
                    </div>                          
				</div><br /> 
				<div class="row">
                	<label class="col-md-4 control-label" for="fonction_id">Fonction  <span class="obligatoire"><sup> *</sup></span></label>
                    <div class="col-md-8"><?= $this->Form->input('fonction_id', ['label' => false,'id'=>'fonction_id',
														   	'div' => false,
															'class' => 'form-control', 
                    										'options' => $fonctions]); ?>
                    </div>                          
				</div><br />
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<p>Consigne de remplissage : Selectionnez la réponse qui vous semble la plus appropriée (1 seul choix).
						<br /><br /><br />
						Votre niveau de satisfaction
						</p>					
					</div>
					<div class="col-md-1"></div>
				</div></br>   
				
				
			<?php  
			foreach ($questions as $question): ?>
				<div class="row">
					<?php if( !empty($question->aide)) { ?>
				
					<label class="col-md-9 control-label fond-vert" for="q_<?= $question->id ?>" >
						<?= $question->groupe." ".$question->name ?>
					</label>
					<div class="col-md-3 BoutonAide">
	                 	<a class="btn btn-xs btn-info" data-toggle="popover" title="Aide"
	                 		data-content="<?= $question->aide ?>"
	                        role="button">Aide</a>
	                 </div> 
	                 <?php } else { ?>
	                 
					<label class="col-md-12 control-label fond-vert" for="q_<?= $question->id ?>" >
						<?= $question->groupe." ".$question->name ?>
					</label>
	                 <?php }?>
				</div>
				 <?php 
				 if($question->type == 1 ) {?>	
				<div class="row">
					<div class="col-md-12"> 
				    	<label class="radio-inline col-md-3" for="q_<?= $question->id ?>-1"><input name="<?= $question->id ?>" id="q_<?= $question->id ?>-1" value="1" type="radio" required="required">Tout à fait d’accord</label>
				    	<label class="radio-inline col-md-2" for="q_<?= $question->id ?>-2"><input name="<?= $question->id ?>" id="q_<?= $question->id ?>-2" value="2" type="radio" required="required">Plutôt d’accord</label> 
				    	<label class="radio-inline col-md-2" for="q_<?= $question->id ?>-3"><input name="<?= $question->id ?>" id="q_<?= $question->id ?>-3" value="3" type="radio" required="required">Plutôt pas d’accord</label> 
				    	<label class="radio-inline col-md-2" for="q_<?= $question->id ?>-4"><input name="<?= $question->id ?>" id="q_<?= $question->id ?>-4" value="4" type="radio" required="required">Pas du tout d’accord</label>
				    	<label class="radio-inline col-md-2" for="q_<?= $question->id ?>-5"><input name="<?= $question->id ?>" id="q_<?= $question->id ?>-5" value="5" type="radio" required="required">Ne se prononce pas</label>
				  	</div>
				</div><br />
   			<?php 
			} else if($question->type == 2 ) { ?>	
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10"> 
					<?php for ($i=1; $i<= 10 ; $i++) { ?>
				    	<label class="radio-inline col-md-1" for="<?= "q_".$question->id."-".$i ?>"><input name="<?= $question->id ?>" id="<?= "q_".$question->id."-".$i ?>" value="<?=$i?>" type="radio" required="required"><?= $i?></label>
				     <?php }?> 
				     </div>
					<div class="col-md-1"></div>
				</div><br />
   				
   			<?php 
   			}
   			endforeach; ?>
			</div>						
			<div class="col-md-1"></div>			
		</div><br /><br />
	<p align="center">
    	<?= $this->Html->link(__('Retour'), ['action' => 'index'],['class' => 'btn btn-info']) ?>
		<?= $this->Form->button('Valider', ['type'=>'submit', 'class' => 'btn btn-default']) ?>
    	<?= $this->Form->end() ?>
	</p>
	<p><span class="obligatoire">&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup></span> Champ obligatoire</p>
	</div>
</div>