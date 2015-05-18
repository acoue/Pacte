<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inscription Entity.
 */
class Inscription extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'date_engagement' => true,
        'numero_demarche' => true,
        'score' => true,
        'etablissement' => true,
        'situation_crise' => true,
        'restructuration' => true,
        'reponses' => true,
        'created' => true,
    ];
}
