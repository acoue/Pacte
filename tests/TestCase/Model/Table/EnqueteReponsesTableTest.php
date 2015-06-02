<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnqueteReponsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnqueteReponsesTable Test Case
 */
class EnqueteReponsesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.enquete_reponses',
        'app.questions',
        'app.reponses',
        'app.demarches',
        'app.equipes',
        'app.users',
        'app.etablissements',
        'app.fonctions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EnqueteReponses') ? [] : ['className' => 'App\Model\Table\EnqueteReponsesTable'];
        $this->EnqueteReponses = TableRegistry::get('EnqueteReponses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnqueteReponses);

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
