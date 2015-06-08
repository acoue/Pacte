<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnqueteQuestion Entity.
 */
class EnqueteQuestion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'groupe' => true,
        'ordre' => true,
        'aide' => true,
        'type' => true,
    ];
}
