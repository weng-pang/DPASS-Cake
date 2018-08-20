<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecordApprovalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecordApprovalsTable Test Case
 */
class RecordApprovalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RecordApprovalsTable
     */
    public $RecordApprovals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.record_approvals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RecordApprovals') ? [] : ['className' => RecordApprovalsTable::class];
        $this->RecordApprovals = TableRegistry::getTableLocator()->get('RecordApprovals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RecordApprovals);

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
