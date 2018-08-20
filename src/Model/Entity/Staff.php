<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $id
 * @property string $name
 * @property string $name2
 * @property \Cake\I18n\FrozenTime $checkin
 * @property \Cake\I18n\FrozenTime $checkout
 * @property int $lunch
 * @property int $overtime
 * @property int $repeatedrange
 * @property int $overtimeapproval
 */
class Staff extends Entity
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
        'name2' => true,
        'checkin' => true,
        'checkout' => true,
        'lunch' => true,
        'overtime' => true,
        'repeatedrange' => true,
        'overtimeapproval' => true
    ];
}
