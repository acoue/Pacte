<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Outils Controller
 *
 * @property \App\Model\Table\OutilsTable $Outils
 */
class OutilsController extends AppController
{
	
	public function isAuthorized($user)
	{
		return parent::isAuthorized($user);
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Phases'],
        	'order' => ['libelle' => 'asc']
        		
        ];
        $this->set('outils', $this->paginate($this->Outils));
        $this->set('_serialize', ['outils']);
    }

    public function initialize() {
    	parent::initialize();
    	$this->loadComponent('Utilitaire');
    }
    
    /**
     * View method
     *
     * @param string|null $id Outil id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $outil = $this->Outils->get($id, [
            'contain' => ['Phases']
        ]);
        $this->set('outil', $outil);
        $this->set('_serialize', ['outil']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {    	
        $outil = $this->Outils->newEntity();
        if ($this->request->is('post')) {
        	//déplacement du fichier
        	$d = $this->request->data;       	
        	
        	//Quand la taille du fichier est trop importante 
        	// c'est à dire les paramètres du php.ini (upload_max_filesize et post_max_size) => formulaire vide
        	if(empty($d)) {
        		$this->Flash->error('La taille du fichier dépasse la limite des 10 Mo.');
        	} else {
        	
	        	$nomFichier = date('YmdHis').$this->Utilitaire->replaceCaracterespeciaux($d['fichier']['name']);  
	        	$destination = DATA.'outil'.DS.$nomFichier;
	        	move_uploaded_file($d['fichier']['tmp_name'], $destination);
	        	
	        	//insertion en base
	        	$outils = TableRegistry::get('Outils');
	        	$query = $outils->query();
	        	$result = $query->insert(['name', 'libelle','thematique','couleur','texte', 'type','ordre','phase_id'])
					        	->values([
					        			'name' => $nomFichier,
					        			'libelle' => $d['libelle'],
					        			'thematique' => $d['thematique'],
					        			'couleur' => $d['couleur'],
					        			'texte' => $d['texte'],
					        			'type' => $d['type'],
					        			'ordre' => $d['ordre'],
					        			'phase_id' => $d['phase_id' ] 
					        	])
					        	->execute();
	        	//debug($result); die();
	        	if($result) {
	        		$this->Flash->success('L\'outil a bien été créé.');
	        		return $this->redirect(['action' => 'index']);        		
	        	} else {
	                $this->Flash->error('Erreur dans la création de l\'outil.');        		
	        	}        	
	        }
	    }
        $phases = $this->Outils->Phases->find('list', ['limit' => 200]);
        $this->set(compact('outil', 'phases'));
        $this->set('_serialize', ['outil']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Outil id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $outil = $this->Outils->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $outil = $this->Outils->patchEntity($outil, $this->request->data);
            if ($this->Outils->save($outil)) {
                $this->Flash->success('L\'outil a bien été sauvegardé.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erreur ans la sauvegarde de l\'outil.');
            }
        }
        $phases = $this->Outils->Phases->find('list', ['limit' => 200]);
        $this->set(compact('outil', 'phases'));
        $this->set('_serialize', ['outil']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Outil id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $outil = $this->Outils->get($id);
        
		//suppression du dossier 
        $destination = DATA.'outil'.DS.$outil->name;
		if(file_exists($destination)) unlink($destination);
        
		//suppresion de la base 
        if ($this->Outils->delete($outil)) {
            $this->Flash->success('L\'outil a bien été supprimé.');
        } else {
            $this->Flash->error('Erreur dans la suppression de l\'outil.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
