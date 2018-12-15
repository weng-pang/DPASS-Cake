<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManagersOrganisationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManagersOrganisationsTable Test Case
 */
class ManagersOrganisationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManagersOrganisationsTable
     */
    public $ManagersOrganisations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.managers_organisations',
        'app.managers',
        'app.organisations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ManagersOrganisations') ? [] : ['className' => ManagersOrganisationsTable::class];
        $this->ManagersOrganisations = TableRegistry::getTableLocator()->get('ManagersOrganisations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ManagersOrganisations);

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
