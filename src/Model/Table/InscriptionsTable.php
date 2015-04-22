<?php
namespace App\Model\Table;

use App\Model\Entity\Inscription;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inscriptions Model
 */
class InscriptionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('inscriptions');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
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
            ->add('date_engagement', 'valid', ['rule' => 'date'])
            ->requirePresence('date_engagement', 'create')
            ->notEmpty('date_engagement')
            ->add('numero_demarche', 'valid', ['rule' => 'numeric'])
            ->requirePresence('numero_demarche', 'create')
            ->notEmpty('numero_demarche')
            ->add('score', 'valid', ['rule' => 'numeric'])
            ->requirePresence('score', 'create')
            ->notEmpty('score')
            ->add('etablissement', 'valid', ['rule' => 'numeric'])
            ->requirePresence('etablissement', 'create')
            ->notEmpty('etablissement')
            ->add('situation_crise', 'valid', ['rule' => 'boolean'])
            ->requirePresence('situation_crise', 'create')
            ->notEmpty('situation_crise')
            ->add('restucturation', 'valid', ['rule' => 'boolean'])
            ->requirePresence('restucturation', 'create')
            ->notEmpty('restucturation')
            ->requirePresence('reponses', 'create')
            ->notEmpty('reponses')
            ->add('ceated', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('ceated');

        return $validator;
    }
}
