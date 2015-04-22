<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reponse Entity.
 */
class Reponse extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'libelle' => true,
        'question_id' => true,
        'demarche_id' => true,
        'question' => true,
        'demarch' => true,
    ];
}
