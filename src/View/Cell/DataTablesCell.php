<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * DataTables cell
 *
 * Parameter usage:
 * useDatePicker: switch for turning Date Picker on/off (Default: true)
 * dateControlColumn: the column for Date Picker / DataTables date comparison (Default:0)
 *
 * @author Weng Long Pang
 * @copyright 2019
 *
 */
class DataTablesCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = ['dateControlColumn','useDatePicker'];
    protected $dateControlColumn = 0;
    protected $useDatePicker = true;

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->set('dateControlColumn', $this->dateControlColumn);
        $this->set('useDatePicker', $this->useDatePicker);
    }
}
