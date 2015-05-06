<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Responsabilite Entity.
 */
class Responsabilite extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'membres' => true,
    ];
}
