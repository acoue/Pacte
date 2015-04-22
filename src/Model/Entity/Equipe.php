<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Equipe Entity.
 */
class Equipe extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'user_id' => true,
        'etablissement_id' => true,
        'user' => true,
        'etablissement' => true,
    ];
}
