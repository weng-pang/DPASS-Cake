<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ManagersOrganisation Entity
 *
 * @property int $id
 * @property int $manager_id
 * @property int $organisation_id
 * @property \Cake\I18n\FrozenTime $create_time
 * @property \Cake\I18n\FrozenTime $update_time
 *
 * @property \App\Model\Entity\Manager $manager
 * @property \App\Model\Entity\Organisation $organisation
 */
class ManagersOrganisation extends Entity
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
        'manager_id' => true,
        'organisation_id' => true,
        'create_time' => true,
        'update_time' => true,
        'manager' => true,
        'organisation' => true
    ];
}
