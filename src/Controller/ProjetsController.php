<?php
namespace App\Controller;

use App\Controller\AppController;
use CakePdf\Pdf\CakePdf;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;

/**
 * Projets Controller
 *
 * @property \App\Model\Table\ProjetsTable $Projets
 */
class ProjetsController extends AppController
{
	public function initialize() {
		parent::initialize();
	}

	public function isAuthorized($user)
	{	
		$session = $this->request->session();
		if( $session->read('Auth.User.role') === 'equipe') {		
			// Droits de tous les utilisateurs connectes sur les actions
			if(in_array($this->request->action, ['index','validate','createPdf', 'diagnostic_index','calendrier','terminateMEO'])){
				return true;
			}
		}		
		return parent::isAuthorized($user);
	}
	

    /**
     * Edit method
     *
     * @param string|null $id Projet id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function index()
    {
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
   	
    	//On retrouve les infos du projet
        $projet = $this->Projets->find('all')
        ->where(['projets.demarche_id'=>$id_demarche])->first();
    	    	    	
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projet = $this->Projets->patchEntity($projet, $this->request->data);
            if ($this->Projets->save($projet)) {
                $this->Flash->success('Le projet a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur dans la sauvegarde du projet.');
            }
        }        
        
		//Recuperation des membres
        $this->loadModel('Membres');
        $membres = $this->Membres->find('all')
        ->contain(['Responsabilites'])
        ->where(['demarche_id' => $id_demarche,'comite'=>0])->order(['nom' => 'asc','prenom' => 'asc']);
        //Controle du bon nombre de referents sur le projet
        // 2 membres referent (->id = 2 ) mini + 1 facilitateur (id = 3)
        $nbReferent = $this->Membres->find()->where(['responsabilite_id' => '2','demarche_id' => $id_demarche,'comite'=>0])->count();
        $nbFacilitateur = $this->Membres->find()->where(['responsabilite_id' => '3','demarche_id' => $id_demarche,'comite'=>0])->count();
        
        if($nbReferent < 2) {
        	$this->Flash->error('Erreur, pour poursuivre, le nombre de membres référent doit être supérieur ou égal à 2');        	
        	return $this->redirect(['controller'=>'membres', 'action' => 'index/0/1']);        	
        } 
        if($nbFacilitateur < 1) {
        	$this->Flash->error('Erreur, pour poursuivre, merci d\'intégrer un facilitateur à l\'équipe');        	
        	return $this->redirect(['controller'=>'membres', 'action' => 'index/0/1']);        	
        }
        
		//Recuperation des membres du ciomite de pilotage
        $membres_comites = $this->Membres->find('all')->where(['demarche_id' => $id_demarche,'comite'=>1]);

        //Recuperation des descriptions de l'equipe
        $this->loadModel('Descriptions');
        $descriptions = $this->Descriptions->find('all')
        ->contain(['Fonctions'])
        ->where(['projet_id' => $projet->id]);
        
        $this->set(compact('projet','membres','membres_comites','descriptions'));
        $this->set('_serialize', ['projet']);
    }
    
    public function calendrier() {
    	//Menu et sous-menu
	    $session = $this->request->session();
	    //On recupere l'identifiant de démarche
	    $id_demarche = $session->read('Equipe.Demarche');
    	
    	//Enregistrement des informations du projet
    	$projetInitial = $this->Projets->find('all')->where(['Projets.demarche_id'=>$id_demarche])->first();
    	$projet = $this->Projets->patchEntity($projetInitial, $this->request->data);
    	if (! $this->Projets->save($projet)) {    		
    		$this->Flash->error('Erreur dans la sauvegarde du projet.');
    		return $this->redirect(['action' => 'index']);
    	}    	 

    	//On retrouve les infos du projet
    	$projet = $this->Projets->find('all')
    	->where(['projets.demarche_id'=>$id_demarche])->first();
    	
    	//Recuperation des etape calendrier du projet
    	$this->loadModel('CalendrierProjets');
    	$calendriers = $this->CalendrierProjets->find('all')
    	->where(['projet_id' => $projet->id]);
    	 
    	$this->set(compact('projet','calendriers'));
    	$this->set('_serialize', ['projet']);
    }
    
    public function validate()
    {    	
		//On recupere l'identifiant de démarche
    	$session = $this->request->session(); 
    	$id_demarche = $session->read('Equipe.Demarche'); 	
    	
    	//Vérification des éléments obigatoires du projet    	
    	$projet = $this->Projets->find('all')
    	->where(['projets.demarche_id'=>$id_demarche])->first();
    	//intitulé du projet
     	if($session->read('Equipe.Engagement') == 0) {
	    	if(strlen($projet->secteur_activite) < 1 ) {
	    		$this->Flash->error('Merci de compléter le champ "Lister le ou les secteur(s) d\'activité(s) participant au projet Pacte" et d\'enregistrer les données');
	    		return $this->redirect(['controller'=>'Projets', 'action' => 'index']);
	    	}
	    	//Modalite de deploiement
	    	if(strlen($projet->definition) < 1 ) {
	    		$this->Flash->error('Merci de compléter le champ "Définir le projet d\'équipe" et d\'enregistrer les données');
	    		return $this->redirect(['controller'=>'Projets', 'action' => 'index']);
	    	}	
     	}
    	
    	//Recuperation des infos de la demarche
    	$this->loadModel('Demarches');
    	$demarche = $this->Demarches->find('all')
    	->where(['Demarches.id' => $id_demarche,'statut'=>0])
    	->first();
    	
    	//Recuperation des infos de l'equipe / etablissement
    	$this->loadModel('Equipes');
    	$equipe = $this->Equipes->find('all')
    	->contain(['Etablissements'])
    	->where(['Equipes.id' => $demarche->equipe_id])
    	->first();
    	
    	//Recuperation des infos des reponses
    	$this->loadModel('Reponses');
    	$reponses = $this->Reponses->find('all')
    	->contain(['Questions'])
    	->where(['Reponses.demarche_id' => $demarche->id])
    	->order(['Questions.ordre' => 'asc']);
    	//$questions = $this->Questions->find('all')->order(['ordre' => 'asc']);


    	//On retrouve les infos du projet
    	$projet = $this->Projets->find('all')
    	->where(['projets.demarche_id'=>$id_demarche])->first();
    	
    	//Recuperation des membres
    	$this->loadModel('Membres');
    	$membres = $this->Membres->find('all')->contain(['Responsabilites'])
    	->where(['Membres.demarche_id' => $id_demarche,'comite'=>0]);
		//Membres referents
    	$membres_referents = $this->Membres->find('all')->contain(['Responsabilites'])
    	->contain(['Responsabilites'])
    	->where(['Membres.demarche_id' => $id_demarche,'comite'=>0,'responsabilite_id > ' => 1]);
    	
    	//Recuperation des membres du comite de pilotage
    	//$this->loadModel('Membres');
    	$membres_comites = $this->Membres->find('all')->where(['demarche_id' => $id_demarche,'comite'=>1]);
    	
    	//Recuperation des descriptions de l'equipe
    	$this->loadModel('Descriptions');
    	$descriptions = $this->Descriptions->find('all')
    	->contain(['Fonctions'])
    	->where(['Descriptions.projet_id' => $projet->id]);
    	
    	//Recuperation des etape calendrier du projet
    	$this->loadModel('CalendrierProjets');
    	$calendriers = $this->CalendrierProjets->find('all')
    	->where(['projet_id' => $projet->id]);
    	
    	if ($this->request->is(['patch', 'post', 'put'])) {
    		
    		//Si demarche engagement est finis    		
    		if($session->read('Equipe.Engagement') == 1 ){
    			
    			$projet = $this->Projets->patchEntity($projet, $this->request->data);
    			if ($this->Projets->save($projet)) {
    				$this->Flash->success('Le projet a bien été sauvegardé.');
    				return $this->redirect(['action' => 'index']);
    			} else {
    				$this->Flash->error('Erreur dans la sauvegarde du projet.');
    			}   			
    			
    		} else {
    		//Si la phase d'engagement est en cours
    			
		    	//Flag dans table demarche_phases => date_validation = now()
	    		$this->loadModel('DemarchePhases');
	    		$dp = $this->DemarchePhases->find('all')
	    		->where(['DemarchePhases.demarche_id' => $id_demarche,'phase_id'=>'1'])
	    		->first();
	    		
	    		$idDemarchePhase = $dp->id;    		
	    		
	    		
	    		
	    		$demarchesPhasesTable = TableRegistry::get('DemarchePhases');
	    		$demarchesPhase = $demarchesPhasesTable->get($idDemarchePhase); 
	    		
	    		$demarchesPhase->date_validation = date('Y-m-d');
	    		if($demarchesPhasesTable->save($demarchesPhase)) $boolOk = true;
	    		else $boolOk = false;
	    		
	    		if($boolOk) {
			    	//Creation dans table demarche_phases pour la phase 2
		    		$demarchesPhase = $demarchesPhasesTable->newEntity();
		    		// Atribution des valeurs
		    		$demarchesPhase->demarche_id = $id_demarche;
		    		$demarchesPhase->phase_id = 2; //Entree dans la premiere phase
		    		$demarchesPhase->date_entree = date('Y-m-d');
		    		
					//Mise à jour de la session : 
		    		$session->write('Equipe.Engagement',1);
		    		$session->write('Equipe.Diagnostic',0);
		    		
		    		//Enregistrement
		    		if($demarchesPhasesTable->save($demarchesPhase)) $boolOk = true;
		    		else $boolOk = false;
		    		
		    		//Creation des 2 evaluations obligatoire CRM Sante et Culture Securite
		    		$evaluationsTable = TableRegistry::get('Evaluations');
		    		$eval = $evaluationsTable->newEntity();
		    		// Atribution des valeurs => CRM Sante
		    		$eval->id = null;
		    		$eval->name = "CRM Santé";
		    		$eval->ordre = 2;
		    		$eval->demarche_id = $id_demarche;
		    		//Enregistrement
		    		$evaluationsTable->save($eval);
		    		
		    		$eval = $evaluationsTable->newEntity();
		    		// Atribution des valeurs => Culture Securite
		    		$eval->id = null;
		    		$eval->name = "Culture Sécurité";
		    		$eval->ordre = 1;
		    		$eval->demarche_id = $id_demarche;
		    		//Enregistrement
		    		$evaluationsTable->save($eval);	    		
		    		
		    		//Creation de la mesure obligatoire Matrice de Maturite
		    		$mesuresTable = TableRegistry::get('Mesures');
		    		$mesure = $mesuresTable->newEntity();
		    		// Atribution des valeurs => Matrice de Maturité
		    		$mesure->id = null;
		    		$mesure->name = "Matrice de Maturité";
		    		$mesure->demarche_id = $id_demarche;
		    		//Enregistrement
		    		$mesuresTable->save($mesure);
		    		
		    		//Creation du repertoire pour le depot des document de l'equipe
		    		$structure = DATA.'userDocument'.DS.$session->read('Auth.User.username');
		    		mkdir($structure, 0777, true);	    			 
		    				
	    		} else {
	    			$message = "une erreur s'est produite lors de la validation de l\'engagement.";
	    			$this->set(compact('message'));
	    			$this->render('validate_refus');
	    		}
	    		
		    	//Redirection vers create_pdf()	    	
	    		if($boolOk) {
	    			$this->redirect(['action' => 'createPdf']);
	    		} else {
	    			$message = "une erreur s'est produite lors de la validation de l\'engagement.";
	    			$this->set(compact('message'));
	    			$this->render('validate_refus');
	    		}
    		}
    	}	

    	$this->set(compact('demarche','equipe','projet','reponses','membres_referents','membres','membres_comites','descriptions','calendriers'));
    	
    }
    
    public function createPdf() {
    	
    	//On recupere l'identifiant de démarche
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	 
//Recuperation des infos de la demarche
    	$this->loadModel('Demarches');
    	$demarche = $this->Demarches->find('all')
    	->where(['Demarches.id' => $id_demarche,'statut'=>0])
    	->first();
    	
    	//Recuperation des infos de l'equipe / etablissement
    	$this->loadModel('Equipes');
    	$equipe = $this->Equipes->find('all')
    	->contain(['Etablissements'])
    	->where(['Equipes.id' => $demarche->equipe_id])
    	->first();
    	
    	//Recuperation des infos des reponses
    	$this->loadModel('Reponses');
    	$reponses = $this->Reponses->find('all')
    	->contain(['Questions'])
    	->where(['Reponses.demarche_id' => $demarche->id])
    	->order(['Questions.ordre' => 'asc']);
    	//$questions = $this->Questions->find('all')->order(['ordre' => 'asc']);


    	//On retrouve les infos du projet
    	$projet = $this->Projets->find('all')
    	->where(['projets.demarche_id'=>$id_demarche])->first();
    	
    	//Recuperation des membres
    	$this->loadModel('Membres');
    	$membres = $this->Membres->find('all')
    	->where(['Membres.demarche_id' => $id_demarche,'comite'=>0]);
		//Membres referents
    	$membres_referents = $this->Membres->find('all')
    	->contain(['Responsabilites'])
    	->where(['Membres.demarche_id' => $id_demarche,'comite'=>0,'responsabilite_id > ' => 1]);
    	
    	//Recuperation des membres du ciomite de pilotage
    	//$this->loadModel('Membres');
    	$membres_comites = $this->Membres->find('all')
    	->contain(['Responsabilites'])
    	->where(['Membres.demarche_id' => $id_demarche,'comite'=> 1]); 
    	
    	
    	//Recuperation des descriptions de l'equipe
    	$this->loadModel('Descriptions');
    	$descriptions = $this->Descriptions->find('all')
    	->contain(['Fonctions'])
    	->where(['Descriptions.projet_id' => $projet->id]);
    	
    	//Recuperation des etape calendrier du projet
    	$this->loadModel('CalendrierProjets');
    	$calendriers = $this->CalendrierProjets->find('all')
    	->where(['projet_id' => $projet->id]);
    	
    	//Conception PDF    	
    	$CakePdf = new \CakePdf\Pdf\CakePdf();
   		$CakePdf->template('recapitulatif', 'default'); 
   		$CakePdf->viewVars(['demarche'=>$demarche,
   					   		'equipe'=>$equipe,
   					   		'projet'=>$projet,
   							'reponses'=>$reponses,
   					   		'membres_referents'=>$membres_referents,
   					   		'membres'=>$membres,
   					   		'membres_comites'=>$membres_comites,
   					   		'descriptions'=>$descriptions,
   							'calendriers'=>$calendriers
   							]);
   		 
   		
	    //Write it to file directly
	    $filename = 'Recapitulatif_'.date('Ymd_His').''.mt_rand().'.pdf';
	    $CakePdf = $CakePdf->write(DATA . 'pdf' . DS . $filename);
    

	    if (ENV_APPLI === 'QUAL') {
	    	$to = EMAIL_ADMIN;
	    	$cc = $to;
	    } else {
		    $to = $cc = "";
		    //On récupere les email des membres referents (TO )+ du facilitateur (CC)	    
		    foreach ($membres_referents as $mr) {
		    	if($mr->responsabilite_id == 2) $to.=$mr->email.";";
		    	else if($mr->responsabilite_id == 3) $cc.=$mr->email.";";
		    }
	    }
    	//Envoie du mail
    	$content = "Votre validation est terminée, vous trouverez ....";
    	$email = new Email('default');
    	$email->template('default')
    	->emailFormat('text')
    	->to($to)
    	->cc($cc)
    	->from('refex@has-sante.fr')
    	->subject('[Pacte] Récapitulatif de l\'engagement')
    	->viewVars(['content' => $content])
    	->attachments(DATA . 'pdf' . DS . $filename)
    	->send();
    
    	//Suppression de la pj
    	unlink(DATA . 'pdf' . DS . $filename);
		//Retour vers la vue
	    $message = "Votre engagement est désormais terminé, vous allre recevoir .... ";
	    $this->set(compact('message'));	    
    }
    
    public function diagnostic_index() {
    	//Menu et sous-menu
	    $session = $this->request->session();
	    $id_demarche = $session->read('Equipe.Demarche');
	   	    
	    if ($this->request->is(['patch', 'post', 'put'])) {
	    	$d = $this->request->data;
	    	$projetTable = TableRegistry::get('Projets');
	    	$projet_edit = $projetTable->get($d['id']);
	    	// Atribution des valeurs
	    	$projet_edit->intitule = $d['intitule'];
	    	$projet_edit->deploiement = $d['deploiement'];
	    	//Enregistrement
	    	if ($projetTable->save($projet_edit)) {
	    		$this->Flash->success('Le projet a bien été sauvegardé.');
	    	} else {
	    		$this->Flash->error('Erreur dans la sauvegarde du projet.');
	    	}
	    	
	    	if($session->read('Equipe.Diagnostic') == 0) {
	    		return $this->redirect(['controller'=>'Evaluations','action' => 'index']);	    		
	    	} else {
	    		return $this->redirect(['action' => 'diagnostic_index']);	    		
	    	}
	    	
	    	
		   	
	    }

	    //On retrouve les infos du projet
	    $projet = $this->Projets->find('all')
	    ->where(['projets.demarche_id'=>$id_demarche])->first();
	     
	    //Recuperation des etape calendrier du projet
	    $this->loadModel('CalendrierProjets');
	    $calendriers = $this->CalendrierProjets->find('all')
	    ->where(['projet_id' => $projet->id]);
	    
	    $this->set(compact('projet','calendriers'));
	    $this->set('_serialize', ['projet']);
    }
    
    public function terminateMEO() {

    	//On recupere l'identifiant de démarche
    	$session = $this->request->session();
    	$id_demarche = $session->read('Equipe.Demarche');
    	
    	//Flag dans table demarche_phases => date_validation = now()
    	$this->loadModel('DemarchePhases');
    	$dp = $this->DemarchePhases->find('all')
    	->where(['DemarchePhases.demarche_id' => $id_demarche,'phase_id'=>'3'])
    	->first();    	
    	$idDemarchePhase = $dp->id;
    	$demarchesPhasesTable = TableRegistry::get('DemarchePhases');
    	$demarchesPhase = $demarchesPhasesTable->get($idDemarchePhase);    	 
    	$demarchesPhase->date_validation = date('Y-m-d');
    	$demarchesPhasesTable->save($demarchesPhase);
    	//Mise à jour de la session :
    	$session->write('Equipe.MiseEnOeuvre',1);
    	
    	//Inscription de l'etape dans la table
    	$demPhase = $demarchesPhasesTable->newEntity();
    	// Atribution des valeurs
    	$demPhase->id = null;    	
    	$demPhase->demarche_id = $id_demarche;
    	$demPhase->phase_id = 4; //Entree dans la premiere phase
    	$demPhase->date_entree = date('Y-m-d');
    	//Enregistrement
    	$demarchesPhasesTable->save($demPhase);
    	//Mise à jour de la session :
    	$session->write('Equipe.Evaluation',0);
    	
    	$this->Flash->success('Phase terminée');
    	return $this->redirect(['controller'=>'Pages', 'action' => 'home']);    	
    }
    
}