<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StaffFixture
 *
 */
class StaffFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'staff';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'staff_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'surname' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'given_names' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'start_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => '09:00:00', 'comment' => '', 'precision' => null],
        'end_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => '20:00:00', 'comment' => '', 'precision' => null],
        'monthly_wage' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'hourly_wage' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'status' => ['type' => 'smallinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['staff_id'], 'length' => []],
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
                'staff_id' => 1,
                'surname' => 'Lorem ipsum dolor sit amet',
                'given_names' => 'Lorem ipsum dolor sit amet',
                'start_time' => '09:32:40',
                'end_time' => '09:32:40',
                'monthly_wage' => 1.5,
                'hourly_wage' => 1.5,
                'status' => 1,
                'update_time' => '2018-11-23 09:32:40',
                'create_time' => '2018-11-23 09:32:40'
            ],
        ];
        parent::init();
    }
}
