<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mark Entity
 *
 * @property int $id
 * @property string $keyword
 * @property bool $enabled
 * @property int $pass_mark
 * @property int $staff_add_record
 * @property int $staff_add_location
 * @property int $staff_add_photo
 * @property int $mark
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 */
class Mark extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'keyword' => true,
        'enabled' => true,
        'pass_mark' => true,
        'staff_add_record' => true,
        'staff_add_location' => true,
        'staff_add_photo' => true,
        'mark' => true,
        'create_time' => true,
        'update_time' => true
    ];
}
