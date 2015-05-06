<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResponsabilitesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResponsabilitesTable Test Case
 */
class ResponsabilitesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Responsabilites' => 'app.responsabilites',
        'Membres' => 'app.membres'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Responsabilites') ? [] : ['className' => 'App\Model\Table\ResponsabilitesTable'];
        $this->Responsabilites = TableRegistry::get('Responsabilites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Responsabilites);

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
}
