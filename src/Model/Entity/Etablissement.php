<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Etablissement Entity.
 */
class Etablissement extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'libelle' => true,
        'finess' => true,
        'numero_demarche' => true,
        'niveau_certif' => true,
        'equipes' => true,
    ];
}
