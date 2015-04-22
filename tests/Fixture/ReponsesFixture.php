<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReponsesFixture
 *
 */
class ReponsesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'libelle' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'question_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'demarche_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'demarche_reponse_fk_idx' => ['type' => 'index', 'columns' => ['demarche_id'], 'length' => []],
            'demarche_question_fk_idx' => ['type' => 'index', 'columns' => ['question_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'demarche_reponse_fk' => ['type' => 'foreign', 'columns' => ['demarche_id'], 'references' => ['demarches', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'demarche_question_fk' => ['type' => 'foreign', 'columns' => ['question_id'], 'references' => ['questions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'libelle' => 'Lorem ipsum dolor sit amet',
            'question_id' => 1,
            'demarche_id' => 1
        ],
    ];
}
