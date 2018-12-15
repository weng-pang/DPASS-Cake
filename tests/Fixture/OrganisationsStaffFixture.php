<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrganisationsStaffFixture
 *
 */
class OrganisationsStaffFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'organisations_staff';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'organisation_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'staff_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'organisation_staff_fk' => ['type' => 'index', 'columns' => ['organisation_id'], 'length' => []],
            'staff_organisation_fk' => ['type' => 'index', 'columns' => ['staff_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'organisation_staff_fk' => ['type' => 'foreign', 'columns' => ['organisation_id'], 'references' => ['organisations', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'staff_organisation_fk' => ['type' => 'foreign', 'columns' => ['staff_id'], 'references' => ['staff', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
                'organisation_id' => 1,
                'staff_id' => 1,
                'create_time' => '2018-12-15 02:09:48'
            ],
        ];
        parent::init();
    }
}
