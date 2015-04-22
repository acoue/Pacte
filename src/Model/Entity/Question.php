<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity.
 */
class Question extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'texte' => true,
        'texte_aide' => true,
        'ordre' => true,
        'reponses' => true,
    ];
}
