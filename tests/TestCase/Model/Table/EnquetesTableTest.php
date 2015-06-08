<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnquetesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnquetesTable Test Case
 */
class EnquetesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.enquetes',
        'app.demarches',
        'app.equipes',
        'app.users',
        'app.etablissements',
        'app.fonctions',
        'app.enquete_reponses',
        'app.questions',
        'app.reponses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Enquetes') ? [] : ['className' => 'App\Model\Table\EnquetesTable'];
        $this->Enquetes = TableRegistry::get('Enquetes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enquetes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
