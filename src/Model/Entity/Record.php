<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Record Entity
 *
 * @property int $record_id
 * @property int $staff_id
 * @property float $longitude
 * @property float $latitude
 * @property float $accuracy
 * @property \Cake\I18n\FrozenTime $time
 * @property string $additional_data
 * @property string $http_user_agent
 * @property string $http_cf_ray
 * @property string $http_cf_connecting_ip
 * @property string $http_cookie
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 */
class Record extends Entity
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
        'longitude' => true,
        'latitude' => true,
        'accuracy' => true,
        'time' => true,
        'additional_data' => true,
        'http_user_agent' => true,
        'http_cf_ray' => true,
        'http_cf_connecting_ip' => true,
        'http_cookie' => true,
        'create_time' => true,
        'update_time' => true
    ];
}
