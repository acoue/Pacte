<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}
	
	public function validationDefault(Validator $validator)
	{
		return $validator
		->notEmpty('username', "Un nom d'utilisateur est n�cessaire")
		->notEmpty('password', 'Un mot de passe est n�cessaire')
		->notEmpty('role', 'Un role est n�cessaire')
		->add('role', 'inList', [
				'rule' => ['inList', ['admin', 'equipe','has','expert']],
				'message' => 'Merci de rentrer un role valide'
		]);
	}

}