<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

	public function initialize(array $config)
	{
		
		$this->table('users');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->hasMany('Equipes', [
				'foreignKey' => 'user_id'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		return $validator
		->notEmpty('username', "Un nom d'utilisateur est nécessaire")
		->notEmpty('password', 'Un mot de passe est nécessaire')
		->notEmpty('role', 'Un role est nécessaire')
		->add('role', 'inList', [
				'rule' => ['inList', ['admin', 'equipe','has','expert']],
				'message' => 'Merci de rentrer un role valide'
		]);
	}

}