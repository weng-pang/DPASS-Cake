<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Link Entity
 *
 * @property int $link_id
 * @property int $staff_id
 * @property string $link
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 *
 * @property \App\Model\Entity\Staff $staff
 */
class Link extends Entity
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
        'staff_id' => true,
        'link' => true,
        'create_time' => true,
        'update_time' => true,
        'staff' => true
    ];
}
