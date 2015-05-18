<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlanAction Entity.
 */
class PlanAction extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'file' => true,
        'is_has' => true,
        'demarche_id' => true,
        'demarch' => true,
    ];
}
