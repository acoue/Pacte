<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EtapePlanAction Entity.
 */
class EtapePlanAction extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'numero' => true,
        'name' => true,
        'pilote' => true,
        'mois' => true,
        'annee' => true,
        'etat' => true,
        'modalite_suivi' => true,
        'resultat' => true,
        'indicateur' => true,
        'plan_action_id' => true,
        'type_indicateur_id' => true,
        'plan_action' => true,
        'type_indicateur' => true,
    ];
}
