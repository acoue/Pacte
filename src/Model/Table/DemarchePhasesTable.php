<?php
namespace App\Model\Table;

use App\Model\Entity\DemarchePhase;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DemarchePhases Model
 */
class DemarchePhasesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('demarche_phases');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Demarches', [
            'foreignKey' => 'demarche_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Phases', [
            'foreignKey' => 'phase_id',
            'joinType' => 'INNER'
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
            ->add('date_entree', 'valid', ['rule' => 'date'])
            ->allowEmpty('date_entree')
            ->add('date_validation', 'valid', ['rule' => 'date'])
            ->allowEmpty('date_validation');

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
        $rules->add($rules->existsIn(['demarche_id'], 'Demarches'));
        $rules->add($rules->existsIn(['phase_id'], 'Phases'));
        return $rules;
    }
}
