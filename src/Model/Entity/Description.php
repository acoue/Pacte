<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Description Entity.
 */
class Description extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'nb_etp' => true,
        'service' => true,
        'fonction_id' => true,
        'projet_id' => true,
        'fonction' => true,
        'projet' => true,
    ];
}
