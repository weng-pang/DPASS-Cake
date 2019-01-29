<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApiKeysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApiKeysTable Test Case
 */
class ApiKeysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApiKeysTable
     */
    public $ApiKeys;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.api_keys'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApiKeys') ? [] : ['className' => ApiKeysTable::class];
        $this->ApiKeys = TableRegistry::getTableLocator()->get('ApiKeys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApiKeys);

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
