<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RecordApproval Entity
 *
 * @property int $serial
 * @property int $record_serial
 * @property int $id
 * @property int $power
 * @property \Cake\I18n\FrozenTime $datetime
 * @property bool $revoked
 * @property \Cake\I18n\FrozenTime $update
 */
class RecordApproval extends Entity
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
        'record_serial' => true,
        'id' => true,
        'power' => true,
        'datetime' => true,
        'revoked' => true,
        'update' => true
    ];
}
