<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhotosScoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhotosScoresTable Test Case
 */
class PhotosScoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PhotosScoresTable
     */
    public $PhotosScores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.photos_scores',
        'app.photos',
        'app.scores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PhotosScores') ? [] : ['className' => PhotosScoresTable::class];
        $this->PhotosScores = TableRegistry::getTableLocator()->get('PhotosScores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PhotosScores);

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
