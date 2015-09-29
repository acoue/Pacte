<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use CakePdf\Pdf\CakePdf;
use PhpParser\Node\Expr\Array_;

/**
 * Equipes Controller
 *
 * @property \App\Model\Table\EquipesTable $Equipes
 */
class EquipesController extends AppController
{
	public function initialize() {
		parent::initialize();		
	}
	
	
	public function isAuthorized($user)
	{		
		return parent::isAuthorized($user);
	}
	
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['index']);
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

    	//debug($this->request->data); die();
    	//Menu et sous-menu
//     	$session = $this->request->session();
//     	$session->write('Progress.Menu','1');
//     	$session->write('Progress.SousMenu','1');

    	
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	//Menu et sous-menu
// 	    $session = $this->request->session();
// 	    $session->write('Progress.Menu','1');
// 	    $session->write('Progress.SousMenu','1');
	    
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Equipe id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipe = $this->Equipes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipe = $this->Equipes->patchEntity($equipe, $this->request->data);
            if ($this->Equipes->save($equipe)) {
                $this->Flash->success('The equipe has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The equipe could not be saved. Please, try again.');
            }
        }
        $users = $this->Equipes->Users->find('list', ['limit' => 200]);
        $etablissements = $this->Equipes->Etablissements->find('list', ['limit' => 200]);
        $this->set(compact('equipe', 'users', 'etablissements'));
        $this->set('_serialize', ['equipe']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipe id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipe = $this->Equipes->get($id);
        if ($this->Equipes->delete($equipe)) {
            $this->Flash->success('The equipe has been deleted.');
        } else {
            $this->Flash->error('The equipe could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function visualisation($type,$idequipe)
    {		
    	
    	//Recuperation des infos de l'equipe / etablissement
    	$equipe = $this->Equipes->find('all',['contain'=>'Etablissements'])->where(['Equipes.id'=>$idequipe])->first();
    	
    	//informations sur le user de l'equipe
    	$user = $this->Equipes->find('all',['contain' => 'Users'])->where(['Equipes.id'=>$idequipe])->first();    
    	$username = $user['user']['username'];	
    	 
    	
    	//informations sur la démarches
    	$this->loadModel('Demarches');
    	$demarche = $this->Demarches->find('all')->where(['Demarches.equipe_id'=>$equipe->id])->first();    	

    	//Etat des pahse de la demarche
    	$this->loadModel('DemarchePhases');
    	$phases = $this->DemarchePhases->find('all',['contain' => 'Phases'])
    	->where(['DemarchePhases.demarche_id'=>$demarche->id])
    	->order('phase_id ASC');
    	
    	//Visualisation pure des informations
    	$this->loadModel('Projets');
    	$projet = $this->Projets->find('all')->where(['Projets.demarche_id'=>$demarche->id])->first();

    	//Recuperation des infos des reponses
    	$this->loadModel('Reponses');
    	$reponses = $this->Reponses->find('all')
    	->contain(['Questions'])
    	->where(['Reponses.demarche_id' => $demarche->id])
    	->order(['Questions.ordre' => 'asc']);
    	
    	//On retrouve les infos du projet
    	$projet = $this->Projets->find('all')
    	->where(['projets.demarche_id'=>$demarche->id])->first();   	
    	
     	//Recuperation des membres
     	$this->loadModel('Membres');
     	$membres = $this->Membres->find('all')
     	->where(['Membres.demarche_id' => $demarche->id,'comite'=>0]);

     	//Membres referents
     	$membres_referents = $this->Membres->find('all')
     	->contain(['Responsabilites'])
     	->where(['Membres.demarche_id' => $demarche->id,'comite'=>0,'responsabilite_id > ' => 1]);
		    	
		//Recuperation des membres du comite de pilotage
		$membres_comites = $this->Membres->find('all')->where(['demarche_id' => $demarche->id,'comite'=>1]);
    	
    	//Recuperation des descriptions de l'equipe
    	$this->loadModel('Descriptions');
    	$descriptions = $this->Descriptions->find('all')
    	->contain(['Fonctions'])
    	->where(['Descriptions.projet_id' => $projet->id]);
    	
    	//Recuperation des etape calendrier du projet
    	$this->loadModel('CalendrierProjets');
    	$calendriers = $this->CalendrierProjets->find('all')
    	->where(['projet_id' => $projet->id]);
    	
    	//Recuperation des evaluation = fonctionnement d'equipe
    	$this->loadModel('Evaluations');
    	$evaluations = $this->Evaluations->find('all')
    	->where(['demarche_id'=>$demarche->id])->order('ordre ASC');    	

    	//On retrouve les infos du plan d'action
    	$this->loadModel('PlanActions');
    	$planAction = $this->PlanActions->find('all')
    	->where(['demarche_id'=>$demarche->id])->first();
    	
    	if($planAction && $planAction->is_has == 1 ) {    	
    		//On retrouve les infos du plan d'action
    		$this->loadModel('EtapePlanActions');
    		$etapePlanActions = $this->EtapePlanActions->find('all')
    		->contain(['PlanActions','TypeIndicateurs'])
    		->where(['PlanActions.demarche_id' => $demarche->id]);
    	} else $etapePlanActions = null;
    	
    	//Recuperation des infos des mesures a t0
    	$this->loadModel('Mesures');
    	$mesures = $this->Mesures->find('all')
    	->where(['Mesures.demarche_id' => $demarche->id]);
    	
    	if($type ==1) { 
    		//generation d'un PDF avec les infos
    		//Conception PDF
     		$CakePdf = new \CakePdf\Pdf\CakePdf();
    		$CakePdf->template('recapitulatif', 'visualisationExpert');
   			$CakePdf->title("Pacte - Etat");
    		$CakePdf->viewVars([
    							'equipe' => $equipe,
    							'demarche' => $demarche,
    							'projet' => $projet,
    							'reponses' => $reponses,
    							'phases' => $phases,
    							'membres' => $membres,
    							'membres_referents' => $membres_referents,
    							'membres_comites' => $membres_comites,
    							'descriptions' => $descriptions,
    							'calendriers' => $calendriers,
    							'evaluations' => $evaluations,
    							'planAction' => $planAction,
    							'etapePlanActions' => $etapePlanActions,
    							'mesures'  => $mesures
    		]);
    		
    		 
    		//Write it to file directly
    		$filename = '__AC_'.date('Ymd_His').''.mt_rand().'.pdf';
    		$CakePdf = $CakePdf->write(DATA . 'pdf' . DS . $filename);
    		
    		$this->autoRender = false;
    		$this->response->type('application/pdf');
    		$this->response->file(DATA . 'pdf' . DS . $filename, ['download' => true, 'name' => date('Y-m-d').'_Pacte_Recapitulatif.pdf']);
    		return $this->response;
    		
    	} 
    	$this->set(compact('equipe','demarche','projet','reponses','phases',
    							'membres','membres_referents','membres_comites','descriptions',
    							'calendriers','evaluations','planAction','etapePlanActions','mesures','username'));
    		 
    }
    
    public function visualisationEnquete($idequipe,$campagne=1)
    {    	    
    	//Informations sur l'équipe
    	$equipe = $this->Equipes->find('all',['contain'=>'Etablissements'])->where(['Equipes.id'=>$idequipe])->first();
    	
    	//informations sur la démarches
    	$this->loadModel('Demarches');
    	$demarche = $this->Demarches->find('all')->where(['Demarches.equipe_id'=>$idequipe])->first();    	
		
		//Recherche du nombre de campagne
    	$this->loadModel('Enquetes');
    	$query = $this->Enquetes->find('all')
    	->where(['Enquetes.demarche_id' => $demarche->id]);     	
    	
    	//Récupération de la campagne la plus élevée
    	$nbCampagne = 0;
    	if($query->count()) {
    		$nbCampagne = $query->max('campagne')->campagne;
    	} 
    	
    	if($nbCampagne > 0 ){
	    	/*
	    	 * 
	    	 * REQUETE pour les Graphique n°1 et n°2 (TYPE 1)
	    	 * 
	    	 */
			//Traitement des répones de type non numérique
	    	$this->loadModel('EnqueteReponses');
	    	$enquetes = $this->EnqueteReponses->find()
	    										->select(['Enquetes.campagne','EnqueteQuestions.name','EnqueteReponses.valeur'])
	    										->contain(['Enquetes','EnqueteQuestions'])
	    										->where(['Enquetes.demarche_id'=>$demarche->id,'EnqueteQuestions.type'=>'1','campagne'=>$campagne])
	    										->order('1,2');
	    	/*
	    	 * 
	    	 * GRAPHIQUE N°1
	    	 * 
	    	 */
	    	
	    	$graphique1 = array();
	    	$graphique1['titre']='% de réponses';
	    	$graphique1['labelYGauche']='%';
	    	
	    	$labelXG1 ='Questions';
	    	$legende1G1 = "Tout à fait d'accord";
	    	$legende2G1 = "Plutôt d'accord";
	    	$legende3G1 = "Plutôt pas d'accord";
	    	$legende4G1 = "Pas du tout d'accord";
	    	$legende5G1 = "NSP";
	    	$iNbRep = -1;
	    	$label = "";
	    	$labelTmp="";
	    	$elt1=0;
	    	$elt2=0;
	    	$elt3=0;
	    	$elt4=0;
	    	$elt5=0;
	    	
	
	    	/*
	    	 * 
	    	 * Tableau des reponses concaténées
	    	 * 
	    	 */
	    	$tabReponse=array();
	    	
	    	/*
	    	 * 
	    	 * GRAPHIQUE N°2
	    	 * 
	    	 */
	    	$graphique2 = array();
	    	$graphique2['titre']='% de réponses positives';
	    	$graphique2['labelX']='%';
	    	
	    	
	    	$tabPosNeg = [['Question','% positif','% négatif']]; 
	    	$repPos =0;
	    	$repNeg =0;    	
	    	
	    	//Ajout aux tableau final de résultats pour le graphique
	    	$tabG1 = [[$labelXG1, $legende1G1, $legende2G1,	$legende3G1,$legende4G1,$legende5G1]];
	    	foreach ($enquetes as $elt) {
	
	    		$graphique1['sousTitre']="Campagne n°".$elt->enquete->campagne;
	    		$graphique2['sousTitre']="Campagne n°".$elt->enquete->campagne;    		
	     		$iNbRep++;
	     		//Recuperation du label de la question
	     		$label = $elt->enquete_question->name;
	     		$valeur = $elt->valeur;
	     		
	     		if($labelTmp === "") { //Premier tour
	     			switch ($valeur) {
	     				case 1:
	     					$elt1 = $elt1+1;
	     					$repPos = $repPos+1;
	     					break;
	     				case 2:
	     					$elt2 = $elt2+1;
	     					$repPos = $repPos+1;
	     					break;
	     				case 3:
	     					$elt3 = $elt3+1;
	     					$repNeg = $repNeg + 1;
	     					break;
	     				case 4:
	     					$elt4 = $elt4+1;
	     					$repNeg = $repNeg + 1;
	     					break;
	     				case 5:
	     					$elt5 = $elt5+1;
	     					break;
	     			}
	     		} else if($label == $labelTmp) {
	     			switch ($valeur) {
	     				case 1:
	     					$elt1 = $elt1+1;
	     					$repPos = $repPos+1;
	     					break;
	     				case 2:
	     					$elt2 = $elt2+1;
	     					$repPos = $repPos+1;
	     					break;
	     				case 3:
	     					$elt3 = $elt3+1;
	     					$repNeg = $repNeg + 1;
	     					break;
	     				case 4:
	     					$elt4 = $elt4+1;
	     					$repNeg = $repNeg + 1;
	     					break;
	     				case 5:
	     					$elt5 = $elt5+1;
	     					break;
	     			}
	     		} else {
	     			//Ajout au tableau
	     			array_push($tabG1,[substr($labelTmp,0,10),(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
	     			array_push($tabPosNeg,[$labelTmp,(100*($repPos/$iNbRep)),100*($repNeg/$iNbRep)]);
	     			array_push($tabReponse,[$labelTmp,(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
	     			//array_push($tabG1,[$labelTmp,$elt1,$elt2,$elt3,$elt4,$elt5]);
	     			$iNbRep = 0; 
	     			$elt1=0;
	     			$elt2=0;
	     			$elt3=0;
	     			$elt4=0;
	     			$elt5=0;
	     			$repPos = $repNeg = 0;
	     			switch ($valeur) {
	     				case 1:
	     					$elt1 = $elt1+1;
	     					$repPos = $repPos+1;
	     					break;
	     				case 2:
	     					$elt2 = $elt2+1;
	     					$repPos = $repPos+1;
	     					break;
	     				case 3:
	     					$elt3 = $elt3+1;
	     					$repNeg = $repNeg + 1;
	     					break;
	     				case 4:
	     					$elt4 = $elt4+1;
	     					$repNeg = $repNeg + 1;
	     					break;
	     				case 5:
	     					$elt5 = $elt5+1;
	     					break;
	     			}     			
	     		}
	     		$labelTmp = $label;
	     		 		
	    	}
	    	//dernier tour
	    	array_push($tabG1,[substr($labelTmp,0,10),(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
	    	array_push($tabPosNeg,[$labelTmp,(100*($repPos/$iNbRep)),100*($repNeg/$iNbRep)]);
	     	array_push($tabReponse,[$labelTmp,(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
	
	     	$graphique1['tabGraphique'] = $tabG1;
	     	$graphique2['tabGraphique'] = $tabPosNeg;
	     	
	     	/*
	     	 *
	     	 * REQUETE pour le Graphique n°3 (TYPE 2)
	     	 *
	     	 */
	     	//Traitement des répones de type non numérique
	     	$this->loadModel('EnqueteReponses');
	     	$enquetes2 = $this->EnqueteReponses->find()
	     	->select(['Enquetes.campagne','EnqueteQuestions.name','EnqueteReponses.valeur'])
	     	->contain(['Enquetes','EnqueteQuestions'])
	     	->where(['Enquetes.demarche_id'=>$demarche->id,'EnqueteQuestions.type'=>'2','campagne'=>$campagne])
	     	->order('1,2');
	     	
	     	/*
	     	 *
	     	 * GRAPHIQUE N°3
	     	 *
	     	 */
	     	$graphique3 = array();
	     	$tabType2 = array();
	     	$graphique3['titre']='Niveau de satisfaction global';
	     	$graphique3['labelYDroit']='Question';
	     	$graphique3['labelX']='Note';
	    	$iNbRep = 0;
	     	$elt1=$elt2=$elt3=$elt4=$elt5=$elt6=$elt7=$elt8=$elt9=0;
	     	
	     	$tabType2 = [['Question', 'Note']];
	     	foreach ($enquetes2 as $elt) {
	     	
	     		$graphique3['sousTitre']="Campagne n°".$elt->enquete->campagne;
	     		$valeur = $elt->valeur;
	     		$iNbRep++;
	     		switch ($valeur) {
	     			case 1:
	     				$elt1+=1;
	     				break;
	     			case 2:
	     				$elt2+=1;
	     				break;
	     			case 3:
	     				$elt3+=1;
	     				break;
	     			case 4:
	     				$elt4+=1;
	     				break;
	     			case 5:
	     				$elt5+=1;
	     				break;
	     			case 6:
	     				$elt6+=1;
	     				break;
	     			case 7:
	     				$elt7+=1;
	     				break;
	     			case 8:
	     				$elt8+=1;
	     				break;
	     			case 9:
	     				$elt9+=1;
	     		}
	     	}
	     	//array_push($tabG1,[substr($labelTmp,0,10),(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
	     	array_push($tabType2,['1',100*($elt1/$iNbRep)]);
	     	array_push($tabType2,['2',100*($elt2/$iNbRep)]);
	     	array_push($tabType2,['3',100*($elt3/$iNbRep)]);
	     	array_push($tabType2,['4',100*($elt4/$iNbRep)]);
	     	array_push($tabType2,['5',100*($elt5/$iNbRep)]);
	     	array_push($tabType2,['6',100*($elt6/$iNbRep)]);
	     	array_push($tabType2,['7',100*($elt7/$iNbRep)]);
	     	array_push($tabType2,['8',100*($elt8/$iNbRep)]);
	     	array_push($tabType2,['9',100*($elt9/$iNbRep)]); 	
	     	$graphique3['tabGraphique'] = $tabType2;
	     	/*
	     	 *
	     	 * Tableau des reponses concaténées
	     	 *
	     	 */
	     	$tabReponseType2=array(['Niveau de satisfaction global concernant le projet PACTE','1','2','3','4','5','6','7','8','9']);
	     	array_push($tabReponseType2,['%',100*($elt1/$iNbRep),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep),100*($elt6/$iNbRep),100*($elt7/$iNbRep),100*($elt8/$iNbRep),100*($elt9/$iNbRep)]);
	     	//debug($tabReponseType2);die();
	     	
	    	$this->set(compact('equipe','nbCampagne','campagne','tabReponse','tabReponseType2','tabPosNeg','graphique1','graphique2','graphique3'));
    	    		
    	} else {
    		$this->set(compact('equipe','nbCampagne'));
    		$this->Flash->error('Auncune enquête pour cette démarche');
    	}    	
    }
    
    public function visualisationEnqueteEvolution($idequipe) {

    	//Informations sur l'équipe
    	$equipe = $this->Equipes->find('all',['contain'=>'Etablissements'])->where(['Equipes.id'=>$idequipe])->first();
    	 
    	//informations sur la démarches
    	$this->loadModel('Demarches');
    	$demarche = $this->Demarches->find('all')->where(['Demarches.equipe_id'=>$idequipe])->first();
    	
    	//Recherche du nombre de campagne
    	$this->loadModel('Enquetes');
    	$query = $this->Enquetes->find('all')
    	->where(['Enquetes.demarche_id' => $demarche->id]);
    	 
    	//Récupération de la campagne la plus élevée
    	$nbCampagne = 0;
    	if($query->count()) {
    		$nbCampagne = $query->max('campagne')->campagne;
    	}

    	if($nbCampagne > 0 ) {
	    	//Traitement des répones de type non numérique
	    	$this->loadModel('EnqueteReponses');
	    	$enquetes = $this->EnqueteReponses->find()
	    	->select(['Enquetes.campagne','EnqueteQuestions.type','EnqueteQuestions.name','EnqueteReponses.valeur'])
	    	->contain(['Enquetes','EnqueteQuestions'])
	    	->where(['Enquetes.demarche_id'=>$demarche->id])
	    	->order('Enquetes.campagne,EnqueteQuestions.ordre');
	    	
	    	$tabReponse=array();
	    	$label=$labelTmp=$typeTmp=$campagneTmp="";
	    	$valeur=0;
	    	$eltPos=0;
	    	$iNbRep=-1;
	    	$noteType2 = 0;
	    	foreach ($enquetes as $rep) {
	    		$label = $rep->enquete_question->name;
	     		$valeur = $rep->valeur;
	     		$type = $rep->enquete_question->type;
	     		$campagne = $rep->enquete->campagne;
	     		
	     		$iNbRep++;
	    		if($labelTmp == "") {
	    			if($type == 2) {
	    				$noteType2=$valeur;
	    			} else {
	    				if( in_array($valeur, ['1','2'])) {
	    					$eltPos+=1;
	    				}
	    			}    
	    		} else {
	    			if($labelTmp==$label) {
	    				if($type == 2) {
	    					$noteType2+=$valeur;
	    				} else {
	    					if( in_array($valeur, ['1','2'])) {
	    						$eltPos+=1;
	    					}
	    				}
	    			} else {    	
	    				if($typeTmp == 2) array_push($tabReponse,[$campagneTmp,$labelTmp,($noteType2/$iNbRep)]);
	    				else array_push($tabReponse,[$campagneTmp,$labelTmp,(100*($eltPos/$iNbRep))]);
	    				
	    				$eltPos=$iNbRep=$noteType2=0;
	    				if($type == 2) {
	    					$noteType2+=$valeur;
	    				} else {
	    					if( in_array($valeur, ['1','2'])) {
	    						$eltPos+=1;
	    					}
	    				}    				
	    			}
	    		}
	    		$labelTmp=$label;
	    		$typeTmp=$type;
	    		$campagneTmp=$campagne;  	
	    	}
	    	//dernier tour
	    	$iNbRep+=1;
	    	if($typeTmp == 2) array_push($tabReponse,[$campagne,$labelTmp,($noteType2/$iNbRep)]);
	    	else array_push($tabReponse,[$campagne,$labelTmp,(100*($eltPos/$iNbRep))]);
	    	
	    	//Traitement de sortie    	
	    	$tabSortie = array();
	    	$tabRepTmp = array();
	    	$nbQuestion=10;
	    	array_push($tabRepTmp, 'Pourcentage de "Tout à fait d\'accord" + "plutôt d\'accord"');
	    	for($j=1;$j<=$nbCampagne;$j++) {
	    		array_push($tabRepTmp,"Campagne ".$j);
	    	}
	    	
	    	array_push($tabSortie,$tabRepTmp);
	    	$tabRepTmp = array();
	     	for($i=0;$i<$nbQuestion;$i++) {
	     		array_push($tabRepTmp,$tabReponse[$i][1]);
	     		for($j=0;$j<$nbCampagne;$j++){
	     			array_push($tabRepTmp,round($tabReponse[$i+($j*$nbQuestion)][2],1));
	     		}
	     		array_push($tabSortie,$tabRepTmp);
	     		$tabRepTmp = array();    		
	     	}
	    	//debug($tabSortie);die();
	    	
	     	// Graphique
	     	$graphiques = array();
	     	
	     	for($i=1;$i<=$nbQuestion;$i++) {
	     		$graphiqueTmp = [['Campagne', 'Note']];
	     		$tabGraphiqueTmp['titre']=$tabSortie[$i][0];
	     		for($j=1;$j<=$nbCampagne;$j++){
	     			array_push($graphiqueTmp,["n°$j",$tabSortie[$i][$j]]);
	     		}
	     		$tabGraphiqueTmp['tabGraphique'] = $graphiqueTmp;
	     		array_push($graphiques,$tabGraphiqueTmp);
	     	}
	     	
	     	    	
	    	
	    	$this->set(compact('equipe','nbCampagne','tabSortie','graphiqueQ1','graphiques'));
    	} else {
    		$this->set(compact('equipe','nbCampagne'));
    		$this->Flash->error('Auncune enquête pour cette démarche');
    	}
    	
    }
}
