<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $serial
 * @property string $key
 * @property string $ip
 * @property string $description
 * @property \Cake\I18n\FrozenTime $time
 * @property string $type
 */
class Log extends Entity
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
        'key' => true,
        'ip' => true,
        'description' => true,
        'time' => true,
        'type' => true
    ];
}
