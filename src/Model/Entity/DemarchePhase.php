<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DemarchePhase Entity.
 */
class DemarchePhase extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'demarche_id' => true,
        'phase_id' => true,
        'date_entree' => true,
        'date_validation' => true,
        'demarch' => true,
        'phase' => true,
    ];
}
