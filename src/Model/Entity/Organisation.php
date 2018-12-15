<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organisation Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 *
 * @property \App\Model\Entity\Manager[] $managers
 * @property \App\Model\Entity\Staff[] $staff
 */
class Organisation extends Entity
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
        'name' => true,
        'create_time' => true,
        'update_time' => true,
        'managers' => true,
        'staff' => true
    ];
}
