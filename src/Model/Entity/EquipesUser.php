<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EquipesUser Entity.
 */
class EquipesUser extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'equipe_id' => true,
        'user_id' => true,
        'equipe' => true,
        'user' => true,
    ];
}
