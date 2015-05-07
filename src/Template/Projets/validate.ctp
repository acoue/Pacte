<p align='center'><h1>Récapitulatif des informations de votre phase d'engagement</h1></p>
<div class="blocblanc">
	<h2>Dossier d'engagement d'une équipe Pacte</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			
			
			
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>

<div class="blocblanc">
	<h2>Dossier d'engagement de la Direction</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			
			
			
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>

<div class="blocblanc">
	<h2>Dossier d'engagement de l'équipe</h2>
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			
			
			
			</div>						
			<div class="col-md-1"></div>
		</div>		
	</div>
</div>

<div class="blocblanc">
	<h2>Fiche d'engagement de l'équipe</h2>
    <h3>Le projet Pacte</h3>    
	<div class="blocblancContent">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			
			
			
			</div>						
			<div class="col-md-1"></div>
		</div><br /><br />
		<div class="row">
        	<p align="center">La validation des renseignement ci-dessus, entrainement l'entrée dans votre démarche d'accréditation.<br/>
                Suite à cette validation, vous recevrez un e-mail récapitulatif des informations ainsi qu'un lien vous demandant l'activation de votre compte / démarche.
                 Il vous ai demandé, pour terminer la phase d'engagement de valider votre compte.
            </p>
<?php 
	$session = $this->request->session();
    if($session->read('Equipe.Engagement') == '0') { 
    	echo "<p align='center'>";
		echo "<a class='btn btn-default' title='Valider' href='inscriptionInfo.html'>Valider</a>&nbsp;&nbsp;&nbsp;";
		echo $this->Html->link(__('Retour'),['controller'=>'projets', 'action'=>'index'],['class'=>'btn btn-info']);
		echo "</p>";
 } ?>
    	</div>
	</div>
</div>
				

