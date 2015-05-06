<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MembresFixture
 *
 */
class MembresFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'nom' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'prenom' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'telephone' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'comite' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '0 : non membre du comité de pilotage
1 : membre du comité de pilotage', 'precision' => null, 'autoIncrement' => null],
        'demarche_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'responsabilite_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fonction_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'service_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fonction_membres_fk_idx' => ['type' => 'index', 'columns' => ['fonction_id'], 'length' => []],
            'services_membres_kf_idx' => ['type' => 'index', 'columns' => ['service_id'], 'length' => []],
            'responsabilite_membres_fk_idx' => ['type' => 'index', 'columns' => ['responsabilite_id'], 'length' => []],
            'demarches_membres_fk_idx' => ['type' => 'index', 'columns' => ['demarche_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fonctions_membres_fk' => ['type' => 'foreign', 'columns' => ['fonction_id'], 'references' => ['fonctions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'services_membres_kf' => ['type' => 'foreign', 'columns' => ['service_id'], 'references' => ['services', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'responsabilite_membres_fk' => ['type' => 'foreign', 'columns' => ['responsabilite_id'], 'references' => ['responsabilites', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'demarches_membres_fk' => ['type' => 'foreign', 'columns' => ['demarche_id'], 'references' => ['demarches', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'nom' => 'Lorem ipsum dolor sit amet',
            'prenom' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'telephone' => 'Lorem ipsum dolor sit amet',
            'comite' => 1,
            'demarche_id' => 1,
            'responsabilite_id' => 1,
            'fonction_id' => 1,
            'service_id' => 1,
            'created' => '2015-05-06 12:41:57',
            'modified' => '2015-05-06 12:41:57'
        ],
    ];
}
