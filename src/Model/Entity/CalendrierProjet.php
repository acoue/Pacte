<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CalendrierProjet Entity.
 */
class CalendrierProjet extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'libelle' => true,
        'mois' => true,
        'annee' => true,
        'projet_id' => true,
        'projet' => true,
    ];
}
