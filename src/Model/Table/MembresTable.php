<?php
namespace App\Model\Table;

use App\Model\Entity\Membre;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Membres Model
 */
class MembresTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('membres');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Demarches', [
            'foreignKey' => 'demarche_id'
        ]);
        $this->belongsTo('Responsabilites', [
            'foreignKey' => 'responsabilite_id'
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
            ->allowEmpty('nom')
            ->allowEmpty('prenom')
            ->add('email', 'valid', ['rule' => 'email'])
            ->allowEmpty('email')
            ->allowEmpty('telephone')
            ->allowEmpty('fonction')
            ->allowEmpty('service')
            ->add('comite', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('comite');

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
        $rules->add($rules->existsIn(['responsabilite_id'], 'Responsabilites'));
        return $rules;
    }
}
