<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $keyword
 * @property string $content
 * @property int $language_id
 * @property int $manager_id
 * @property int $dpass_rest_enabled
 * @property int $dpass_rest_code
 * @property string $dpass_rest_add_address
 * @property string $dpass_rest_key
 * @property int $staffadd_wait_time
 * @property int $staffadd_view_limit
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 *
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\Manager $manager
 */
class Setting extends Entity
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
        'keyword' => true,
        'content' => true,
        'language_id' => true,
        'manager_id' => true,
        'dpass_rest_enabled' => true,
        'dpass_rest_code' => true,
        'dpass_rest_add_address' => true,
        'dpass_rest_key' => true,
        'staffadd_wait_time' => true,
        'staffadd_view_limit' => true,
        'create_time' => true,
        'update_time' => true,
        'language' => true,
        'manager' => true
    ];
}
