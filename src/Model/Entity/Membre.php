<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Membre Entity.
 */
class Membre extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nom' => true,
        'prenom' => true,
        'email' => true,
        'telephone' => true,
        'comite' => true,
        'demarche_id' => true,
        'responsabilite_id' => true,
        'fonction' => true,
        'service' => true,
        'demarch' => true,
        'responsabilite' => true,
        'fonction' => true,
        'service' => true,
    ];
}
