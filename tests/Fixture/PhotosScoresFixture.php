<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PhotosScoresFixture
 *
 */
class PhotosScoresFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'photo_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'score_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'photo_score_fk' => ['type' => 'index', 'columns' => ['photo_id'], 'length' => []],
            'score_photo_fk' => ['type' => 'index', 'columns' => ['score_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'photo_score_fk' => ['type' => 'foreign', 'columns' => ['photo_id'], 'references' => ['photos', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'score_photo_fk' => ['type' => 'foreign', 'columns' => ['score_id'], 'references' => ['scores', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
                'id' => 1,
                'photo_id' => 1,
                'score_id' => 1,
                'create_time' => '2018-12-15 11:01:23'
            ],
        ];
        parent::init();
    }
}
