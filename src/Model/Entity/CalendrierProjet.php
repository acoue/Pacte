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
        'mois_debut' => true,
        'annee_debut' => true,
        'mois_fin' => true,
        'annee_fin' => true,
        'projet_id' => true,
        'projet' => true,
    ];
}
