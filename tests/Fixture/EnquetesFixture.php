<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EnquetesFixture
 *
 */
class EnquetesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'service' => ['type' => 'string', 'length' => 2100, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'demarche_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fonction_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'demarche_enquete_fk_idx' => ['type' => 'index', 'columns' => ['demarche_id'], 'length' => []],
            'fonction_enquete_idx' => ['type' => 'index', 'columns' => ['fonction_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'demarche_enquete_fk' => ['type' => 'foreign', 'columns' => ['demarche_id'], 'references' => ['demarches', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fonction_enquete' => ['type' => 'foreign', 'columns' => ['fonction_id'], 'references' => ['fonctions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
            'service' => 'Lorem ipsum dolor sit amet',
            'demarche_id' => 1,
            'fonction_id' => 1,
            'created' => '2015-06-02 13:40:40',
            'modified' => '2015-06-02 13:40:40'
        ],
    ];
}
