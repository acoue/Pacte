<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projet Entity.
 */
class Projet extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'mission' => true,
        'secteur_activite' => true,
        'definition' => true,
        'communication' => true,
        'demarche_id' => true,
        'demarch' => true,
    ];
}
