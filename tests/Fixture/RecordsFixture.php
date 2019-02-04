<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RecordsFixture
 *
 */
class RecordsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'staff_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'machine_code' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rest_serial' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'longitude' => ['type' => 'decimal', 'length' => 11, 'precision' => 7, 'unsigned' => false, 'null' => true, 'default' => '1000.0000000', 'comment' => ''],
        'latitude' => ['type' => 'decimal', 'length' => 11, 'precision' => 7, 'unsigned' => false, 'null' => true, 'default' => '1000.0000000', 'comment' => ''],
        'accuracy' => ['type' => 'decimal', 'length' => 10, 'precision' => 5, 'unsigned' => false, 'null' => true, 'default' => '0.00000', 'comment' => ''],
        'time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'additional_data' => ['type' => 'string', 'length' => 1000, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'http_user_agent' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'http_cf_ray' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'http_cf_connecting_ip' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'http_cookie' => ['type' => 'string', 'length' => 1000, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'staff_id_fk_idx' => ['type' => 'index', 'columns' => ['staff_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'records_staff_id_fk' => ['type' => 'foreign', 'columns' => ['staff_id'], 'references' => ['staff', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
                'staff_id' => 1,
                'machine_code' => 1,
                'rest_serial' => 1,
                'longitude' => 1.5,
                'latitude' => 1.5,
                'accuracy' => 1.5,
                'time' => '2019-01-30 13:16:51',
                'additional_data' => 'Lorem ipsum dolor sit amet',
                'http_user_agent' => 'Lorem ipsum dolor sit amet',
                'http_cf_ray' => 'Lorem ipsum dolor sit amet',
                'http_cf_connecting_ip' => 'Lorem ipsum dolor sit amet',
                'http_cookie' => 'Lorem ipsum dolor sit amet',
                'create_time' => '2019-01-30 13:16:51',
                'update_time' => '2019-01-30 13:16:51'
            ],
        ];
        parent::init();
    }
}
