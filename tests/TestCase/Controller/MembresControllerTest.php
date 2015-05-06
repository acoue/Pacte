<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MembresController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MembresController Test Case
 */
class MembresControllerTest extends IntegrationTestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
