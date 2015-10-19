<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Outil Entity.
 */
class Outil extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'texte' => true,
        'libelle' => true,
        'type' => true,
    	'ordre' => true,
        'phase_id' => true,
        'phase' => true,
    ];
}
