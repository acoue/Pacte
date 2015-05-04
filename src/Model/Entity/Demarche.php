<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Demarch Entity.
 */
class Demarche extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'date_engagement' => true,
        'score' => true,
        'reponse' => true,
        'situation_crise' => true,
        'restructuration' => true,
        'statut' => true,
        'equipe_id' => true,
        'equipe' => true,
    ];
}