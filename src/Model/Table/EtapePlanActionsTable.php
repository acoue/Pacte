<?php
namespace App\Model\Table;

use App\Model\Entity\EtapePlanAction;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EtapePlanActions Model
 */
class EtapePlanActionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('etape_plan_actions');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('TypeIndicateurs', [
            'foreignKey' => 'type_indicateur_id'
        ]);
        $this->belongsTo('PlanActions', [
            'foreignKey' => 'plan_action_id'
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
            ->add('numero', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('numero');
            
        $validator
            ->allowEmpty('name');
            
        $validator
            ->allowEmpty('pilote');
            
        $validator
            ->allowEmpty('mois');
            
        $validator
            ->add('annee', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('annee');
            
        $validator
            ->allowEmpty('etat');
            
        $validator
            ->allowEmpty('modalite_suivi');

        $validator
            ->allowEmpty('resultat');
        
        $validator
            ->allowEmpty('indicateur');

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
        $rules->add($rules->existsIn(['type_indicateur_id'], 'TypeIndicateurs'));
        $rules->add($rules->existsIn(['plan_action_id'], 'PlanActions'));
        return $rules;
    }
}
