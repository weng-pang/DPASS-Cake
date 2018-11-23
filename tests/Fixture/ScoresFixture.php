<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ScoresFixture
 *
 */
class ScoresFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'score_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'record_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'manager_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'score' => ['type' => 'smallinteger', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'notes' => ['type' => 'string', 'length' => 1000, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'manager_fk_idx' => ['type' => 'index', 'columns' => ['manager_id'], 'length' => []],
            'record_fk_idx' => ['type' => 'index', 'columns' => ['record_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['score_id'], 'length' => []],
            'scores_manager_id_fk' => ['type' => 'foreign', 'columns' => ['manager_id'], 'references' => ['managers', 'manager_id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'scores_record_id_fk' => ['type' => 'foreign', 'columns' => ['record_id'], 'references' => ['records', 'record_id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'score_id' => 1,
                'record_id' => 1,
                'manager_id' => 1,
                'score' => 1,
                'notes' => 'Lorem ipsum dolor sit amet',
                'create_time' => '2018-11-23 09:33:14',
                'update_time' => '2018-11-23 09:33:14'
            ],
        ];
        parent::init();
    }
}
