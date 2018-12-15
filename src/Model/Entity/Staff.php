<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $id
 * @property string $surname
 * @property string $given_names
 * @property \Cake\I18n\FrozenTime $start_time
 * @property \Cake\I18n\FrozenTime $end_time
 * @property float $monthly_wage
 * @property float $hourly_wage
 * @property int $status
 * @property \Cake\I18n\FrozenTime $update_time
 * @property \Cake\I18n\FrozenTime $create_time
 *
 * @property \App\Model\Entity\Link[] $links
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
        'surname' => true,
        'given_names' => true,
        'start_time' => true,
        'end_time' => true,
        'monthly_wage' => true,
        'hourly_wage' => true,
        'status' => true,
        'update_time' => true,
        'create_time' => true,
        'links' => true
    ];
}
