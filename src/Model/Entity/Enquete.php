<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enquete Entity.
 */
class Enquete extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'service' => true,
        'campagne' => true,
        'demarche_id' => true,
        'fonction_id' => true,
        'demarch' => true,
        'fonction' => true,
        'enquete_reponses' => true,
    ];
}
