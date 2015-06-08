<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EnqueteReponsesFixture
 *
 */
class EnqueteReponsesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'valeur' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '1 = Tout à fait d’accord
2 = Plutôt d’accord
3 = Plutôt pas d’accord
4 = Pas du tout d’accord
5 = Ne se prononce pas', 'precision' => null, 'fixed' => null],
        'enquete_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'question_enquete_reponse_fk' => ['type' => 'index', 'columns' => ['question_id'], 'length' => []],
            'enquete_reponse_enquete_fk_idx' => ['type' => 'index', 'columns' => ['enquete_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'question_reponse_enquete_fk' => ['type' => 'foreign', 'columns' => ['question_id'], 'references' => ['enquete_questions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'enquete_reponse_enquete_fk' => ['type' => 'foreign', 'columns' => ['enquete_id'], 'references' => ['enquetes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'valeur' => 'Lorem ipsum dolor sit amet',
            'enquete_id' => 1,
            'question_id' => 1,
            'created' => '2015-06-02 13:40:31',
            'modified' => '2015-06-02 13:40:31'
        ],
    ];
}
