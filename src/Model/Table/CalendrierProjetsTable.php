<?php
namespace App\Model\Table;

use App\Model\Entity\CalendrierProjet;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CalendrierProjets Model
 */
class CalendrierProjetsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('calendrier_projets');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('libelle', 'create')
            ->notEmpty('libelle');
            
        $validator
            ->requirePresence('mois', 'create')
            ->notEmpty('mois');
            
        $validator
            ->add('annee', 'valid', ['rule' => 'numeric'])
            ->requirePresence('annee', 'create')
            ->notEmpty('annee');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['projet_id'], 'Projets'));
        return $rules;
    }
}
