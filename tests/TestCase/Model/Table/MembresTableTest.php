<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MembresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MembresTable Test Case
 */
class MembresTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Membres' => 'app.membres',
        'Demarches' => 'app.demarches',
        'Equipes' => 'app.equipes',
        'Users' => 'app.users',
        'Etablissements' => 'app.etablissements',
        'Responsabilites' => 'app.responsabilites',
        'Fonctions' => 'app.fonctions',
        'Services' => 'app.services'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Membres') ? [] : ['className' => 'App\Model\Table\MembresTable'];
        $this->Membres = TableRegistry::get('Membres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Membres);

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
