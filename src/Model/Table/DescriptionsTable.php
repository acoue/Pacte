<?php
namespace App\Model\Table;

use App\Model\Entity\Description;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Descriptions Model
 */
class DescriptionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('descriptions');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Fonctions', [
            'foreignKey' => 'fonction_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
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
            ->add('nb_etp', 'valid', ['rule' => 'numeric'])
            ->requirePresence('nb_etp', 'create')
            ->notEmpty('nb_etp');
                    

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
        $rules->add($rules->existsIn(['fonction_id'], 'Fonctions'));
        $rules->add($rules->existsIn(['projet_id'], 'Projets'));
        return $rules;
    }
}
