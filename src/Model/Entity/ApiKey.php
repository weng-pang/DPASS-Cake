<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApiKey Entity
 *
 * @property int $id
 * @property string $key
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 * @property \Cake\I18n\FrozenTime $expire
 * @property bool $revoked
 * @property string $comment
 */
class ApiKey extends Entity
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
        'create_time' => true,
        'update_time' => true,
        'expire' => true,
        'revoked' => true,
        'comment' => true
    ];
}
