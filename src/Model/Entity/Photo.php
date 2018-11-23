<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Photo Entity
 *
 * @property int $photo_id
 * @property int $score_id
 * @property string $photo_path
 * @property string $metadata
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 *
 * @property \App\Model\Entity\Score $score
 */
class Photo extends Entity
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
        'score_id' => true,
        'photo_path' => true,
        'metadata' => true,
        'create_time' => true,
        'update_time' => true,
        'score' => true
    ];
}
