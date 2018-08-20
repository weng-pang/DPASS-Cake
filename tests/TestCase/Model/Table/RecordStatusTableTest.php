<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecordStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecordStatusTable Test Case
 */
class RecordStatusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RecordStatusTable
     */
    public $RecordStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.record_status'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RecordStatus') ? [] : ['className' => RecordStatusTable::class];
        $this->RecordStatus = TableRegistry::getTableLocator()->get('RecordStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RecordStatus);

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
