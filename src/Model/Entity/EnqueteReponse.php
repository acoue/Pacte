<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnqueteReponse Entity.
 */
class EnqueteReponse extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'valeur' => true,
        'enquete_id' => true,
        'question_id' => true,
        'enquete_question' => true,
        'demarch' => true,
        'fonction' => true,
    ];
}
