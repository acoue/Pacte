<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Demarch Entity.
 */
class Demarch extends Entity
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
        'equipe_id' => true,
        'equipe' => true,
    ];
}
