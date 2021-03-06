<?php
namespace App\Model\Table;

use App\Model\Entity\Outil;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Outils Model
 */
class OutilsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('outils');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Phases', [
            'foreignKey' => 'phase_id'
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
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('libelle', 'create')
            ->notEmpty('libelle')
            ->requirePresence('texte', 'create')
            ->notEmpty('texte')
            ->requirePresence('ordre', 'create')
            ->notEmpty('ordre')
            ->requirePresence('type', 'create')
            ->notEmpty('type')
            ->requirePresence('thematique', 'create')
            ->notEmpty('thematique')
            ->requirePresence('couleur', 'create')
            ->notEmpty('couleur');

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
        $rules->add($rules->existsIn(['phase_id'], 'Phases'));
        return $rules;
    }
}
