<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class EnqueteSatisfactionComponent extends Component {
	
	public function getEnqueteParCampagneGraphique1($enquetes){

    	$graphique1 = array();
    	$graphique1['titre']='% de réponses';
    	$graphique1['labelYGauche']='%';
    	$graphique1['labelX']='Questions';

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
	    	
    	//Ajout aux tableau final de résultats pour le graphique
    	$tabG1 = [[$labelXG1, $legende1G1, $legende2G1,	$legende3G1,$legende4G1,$legende5G1]];
	    	
	    foreach ($enquetes as $elt) {

    		$graphique1['sousTitre']="Campagne n°".$elt->enquete->campagne;
     		$iNbRep++;
     		//Recuperation du label de la question
     		$label = $elt->enquete_question->libelle;
     		$valeur = $elt->valeur;

     		if($labelTmp === "") { //Premier tour
     			switch ($valeur) {
     				case 1:
     					$elt1 = $elt1+1;
     					break;
     				case 2:
     					$elt2 = $elt2+1;
     					break;
     				case 3:
     					$elt3 = $elt3+1;
     					break;
     				case 4:
     					$elt4 = $elt4+1;
     					break;
     				case 5:
     					$elt5 = $elt5+1;
     					break;
     			}
     		} else if($label == $labelTmp) {
     			switch ($valeur) {
     				case 1:
     					$elt1 = $elt1+1;
     					break;
     				case 2:
     					$elt2 = $elt2+1;
     					break;
     				case 3:
     					$elt3 = $elt3+1;
     					break;
     				case 4:
     					$elt4 = $elt4+1;
     					break;
     				case 5:
     					$elt5 = $elt5+1;
     					break;
     			}
     		} else {
     			//Ajout au tableau
     			//array_push($tabG1,[substr($labelTmp,0,20),(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
     			array_push($tabG1,[$labelTmp,
     								round(100*($elt1/$iNbRep),1),
     								round(100*($elt2/$iNbRep),1),
     								round(100*($elt3/$iNbRep),1),
     								round(100*($elt4/$iNbRep),1),
     								round(100*($elt5/$iNbRep),1)]);
     			$iNbRep = 0;
     			$elt1=$elt2=$elt3=$elt4=$elt5=0;
     			
     			switch ($valeur) {
     				case 1:
     					$elt1 = $elt1+1;
     					break;
     				case 2:
     					$elt2 = $elt2+1;
     					break;
     				case 3:
     					$elt3 = $elt3+1;
     					break;
     				case 4:
     					$elt4 = $elt4+1;
     					break;
     				case 5:
     					$elt5 = $elt5+1;
     					break;
     			}
     		}
     		$labelTmp = $label; 
    	}
    	
    	$graphique1['tabGraphique'] = $tabG1;
	    
		return $graphique1;
	}
	
	public function getEnqueteParCampagneReponseGraphique1($enquetes) {
		$tabReponse=array();
		$iNbRep = -1;
	    $label = "";
	    $labelTmp="";
	    $elt1=$elt2=$elt3=$elt4=$elt5=0;
		
		foreach ($enquetes as $elt) {
			$iNbRep++;
			//Recuperation du label de la question
			$label = $elt->enquete_question->name;
			$valeur = $elt->valeur;
		
			if($labelTmp === "") { //Premier tour
				switch ($valeur) {
					case 1:
						$elt1 = $elt1+1;
						break;
					case 2:
						$elt2 = $elt2+1;
						break;
					case 3:
						$elt3 = $elt3+1;
						break;
					case 4:
						$elt4 = $elt4+1;
						break;
					case 5:
						$elt5 = $elt5+1;
						break;
				}
			} else if($label == $labelTmp) {
				switch ($valeur) {
					case 1:
						$elt1 = $elt1+1;
						break;
					case 2:
						$elt2 = $elt2+1;
						break;
					case 3:
						$elt3 = $elt3+1;
						break;
					case 4:
						$elt4 = $elt4+1;
						break;
					case 5:
						$elt5 = $elt5+1;
						break;
				}
			} else {
				//Ajout au tableau
				array_push($tabReponse,[$labelTmp,(100*($elt1/$iNbRep)),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep)]);
				$iNbRep = 0;
				$elt1=$elt2=$elt3=$elt4=$elt5=$repPos=$repNeg=0;
				switch ($valeur) {
					case 1:
						$elt1 = $elt1+1;
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
		
		return $tabReponse;
	}
	
	public function getEnqueteParCampagneGraphique2($enquetes) {		
		
		$iNbRep = -1;
		$label = $labelTmp="";
		$graphique2 = array();
		$graphique2['titre']='% de réponses positives / négatives';
		$graphique2['labelX']='%';
		$tabPosNeg = [['Question','% Pos','% Neg']];
		$repPos = $repNeg = 0;
		
		//Ajout aux tableau final de résultats pour le graphique
		foreach ($enquetes as $elt) {
			$graphique2['sousTitre']="Campagne n°".$elt->enquete->campagne;
			$iNbRep++;
			//Recuperation du label de la question
			$label = $elt->enquete_question->libelle;
			$valeur = $elt->valeur;
		
			if($labelTmp === "") { //Premier tour
				switch ($valeur) {
					case 1:
						$repPos = $repPos+1;
						break;
					case 2:
						$repPos = $repPos+1;
						break;
					case 3:
						$repNeg = $repNeg + 1;
						break;
					case 4:
						$repNeg = $repNeg + 1;
						break;
				}
			} else if($label == $labelTmp) {
				switch ($valeur) {
					case 1:
						$repPos = $repPos+1;
						break;
					case 2:
						$repPos = $repPos+1;
						break;
					case 3:
						$repNeg = $repNeg + 1;
						break;
					case 4:
						$repNeg = $repNeg + 1;
						break;
				}
			} else {
				//Ajout au tableau
				array_push($tabPosNeg,[$labelTmp,(100*($repPos/$iNbRep)),100*($repNeg/$iNbRep)]);
				$iNbRep = 0;
				$repPos = $repNeg = 0;
				switch ($valeur) {
					case 1:
						$repPos = $repPos+1;
						break;
					case 2:
						$repPos = $repPos+1;
						break;
					case 3:
						$repNeg = $repNeg + 1;
						break;
					case 4:
						$repNeg = $repNeg + 1;
						break;
				}
			}
			$labelTmp = $label;
			 
		}
		
		$graphique2['tabGraphique'] = $tabPosNeg;
		return $graphique2;
	}	
	
	public function getEnqueteParCampagneGraphique3($enquetes) {

		$graphique3 = array();
		$tabType2 = array();
		$graphique3['titre']='Niveau de satisfaction global';
		$graphique3['labelYDroit']='Question';
		$graphique3['labelX']='Note';
		$iNbRep = 0;
		$elt1=$elt2=$elt3=$elt4=$elt5=$elt6=$elt7=$elt8=$elt9=0;
		 
		$tabType2 = [['Question', 'Note']];
		foreach ($enquetes as $elt) {
			 
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
		array_push($tabType2,['1',round(100*($elt1/$iNbRep),1)]);
		array_push($tabType2,['2',round(100*($elt2/$iNbRep),1)]);
		array_push($tabType2,['3',round(100*($elt3/$iNbRep),1)]);
		array_push($tabType2,['4',round(100*($elt4/$iNbRep),1)]);
		array_push($tabType2,['5',round(100*($elt5/$iNbRep),1)]);
		array_push($tabType2,['6',round(100*($elt6/$iNbRep),1)]);
		array_push($tabType2,['7',round(100*($elt7/$iNbRep),1)]);
		array_push($tabType2,['8',round(100*($elt8/$iNbRep),1)]);
		array_push($tabType2,['9',round(100*($elt9/$iNbRep),1)]);
		$graphique3['tabGraphique'] = $tabType2;
		
		return $graphique3;
	}

	public function getEnqueteParCampagneReponseType2($enquetes){
		$tabReponseType2=array(['Niveau de satisfaction global concernant le projet PACTE','1','2','3','4','5','6','7','8','9']);
		$elt1=$elt2=$elt3=$elt4=$elt5=$elt6=$elt7=$elt8=$elt9=0;			
		$iNbRep = 0;
		foreach ($enquetes as $elt) {
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
		array_push($tabReponseType2,['%',100*($elt1/$iNbRep),100*($elt2/$iNbRep),100*($elt3/$iNbRep),100*($elt4/$iNbRep),100*($elt5/$iNbRep),100*($elt6/$iNbRep),100*($elt7/$iNbRep),100*($elt8/$iNbRep),100*($elt9/$iNbRep)]);
		return $tabReponseType2;
	}

	public function getEnqueteEvolution($tabReponse,$nbCampagne) {
	
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
		
		// Graphique
		$graphiques = array();
		 
		for($i=1;$i<=$nbQuestion;$i++) {
			$graphiqueTmp = [['Campagne', '% de réponses positives']];
			$tabGraphiqueTmp['titre']=$tabSortie[$i][0];
			for($j=1;$j<=$nbCampagne;$j++){
				array_push($graphiqueTmp,["n°$j",$tabSortie[$i][$j]]);
			}
			$tabGraphiqueTmp['tabGraphique'] = $graphiqueTmp;
			array_push($graphiques,$tabGraphiqueTmp);
		}
		
		return $graphiques;
	}
	
	public function getEnqueteEvolutionTableauSortie($tabReponse,$nbCampagne) {
	
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
		
		
		for($i=1;$i<=$nbQuestion;$i++) {
			$graphiqueTmp = [['Campagne', 'Note']];
			$tabGraphiqueTmp['titre']=$tabSortie[$i][0];
			for($j=1;$j<=$nbCampagne;$j++){
				array_push($graphiqueTmp,["n°$j",$tabSortie[$i][$j]]);
			}
		}
		
		return $tabSortie;
	}
	
	public function getEnqueteEvolutionTableauReponse($enquetes,$nbCampagne) {
	
		$tabReponse=array();
		$label=$labelTmp=$typeTmp=$campagneTmp="";
		$valeur=0;
		$eltPos=0;
		$iNbRep=0;
		$noteType2 = 0;
		foreach ($enquetes as $rep) {
			$label = $rep->enquete_question->libelle;
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
	
		
		return $tabReponse;
	}

}