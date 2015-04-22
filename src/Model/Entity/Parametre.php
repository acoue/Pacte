<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parametre Entity.
 */
class Parametre extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'valeur' => true,
    ];
}
