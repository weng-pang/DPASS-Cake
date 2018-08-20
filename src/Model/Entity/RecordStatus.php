<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RecordStatus Entity
 *
 * @property int $serial
 * @property int $status
 * @property int $new_serial
 */
class RecordStatus extends Entity
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
        'new_serial' => true
    ];
}
