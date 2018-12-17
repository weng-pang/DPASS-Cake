<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Score Entity
 *
 * @property int $id
 * @property int $record_id
 * @property int $manager_id
 * @property int $score
 * @property string $notes
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 *
 * @property \App\Model\Entity\Record $record
 * @property \App\Model\Entity\Manager $manager
 *
 * @property \App\Model\Entity\Photo[] $photos
 */
class Score extends Entity
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
        'record_id' => true,
        'manager_id' => true,
        'score' => true,
        'notes' => true,
        'create_time' => true,
        'update_time' => true,
        'record' => true,
        'manager' => true
    ];
}
