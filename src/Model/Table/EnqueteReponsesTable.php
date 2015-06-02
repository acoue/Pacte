<?php
namespace App\Model\Table;

use App\Model\Entity\EnqueteReponse;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnqueteReponses Model
 */
class EnqueteReponsesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('enquete_reponses');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Demarches', [
            'foreignKey' => 'demarche_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Fonctions', [
            'foreignKey' => 'fonction_id',
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
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('valeur', 'create')
            ->notEmpty('valeur');
            
        $validator
            ->requirePresence('service', 'create')
            ->notEmpty('service');

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
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['demarche_id'], 'Demarches'));
        $rules->add($rules->existsIn(['fonction_id'], 'Fonctions'));
        return $rules;
    }
}
