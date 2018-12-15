<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PhotosScore Entity
 *
 * @property int $id
 * @property int $photo_id
 * @property int $score_id
 * @property \Cake\I18n\FrozenTime $create_time
 *
 * @property \App\Model\Entity\Photo $photo
 * @property \App\Model\Entity\Score $score
 */
class PhotosScore extends Entity
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
        'photo_id' => true,
        'score_id' => true,
        'create_time' => true,
        'photo' => true,
        'score' => true
    ];
}
