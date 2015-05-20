<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mesure Entity.
 */
class Mesure extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'resultat' => true,
        'file' => true,
        'demarche_id' => true,
        'demarch' => true,
    ];
}
