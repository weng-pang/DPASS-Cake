<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganisationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganisationsTable Test Case
 */
class OrganisationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganisationsTable
     */
    public $Organisations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organisations',
        'app.managers',
        'app.staff'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Organisations') ? [] : ['className' => OrganisationsTable::class];
        $this->Organisations = TableRegistry::getTableLocator()->get('Organisations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Organisations);

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
