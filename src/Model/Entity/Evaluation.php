<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evaluation Entity.
 */
class Evaluation extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'synthese' => true,
        'file' => true,
        'demarche_id' => true,
        'demarch' => true,
    ];
}
