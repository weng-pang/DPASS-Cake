<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganisationsStaff Entity
 *
 * @property int $id
 * @property int $organisation_id
 * @property int $staff_id
 * @property \Cake\I18n\FrozenTime $create_time
 *
 * @property \App\Model\Entity\Organisation $organisation
 * @property \App\Model\Entity\Staff $staff
 */
class OrganisationsStaff extends Entity
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
        'organisation_id' => true,
        'staff_id' => true,
        'create_time' => true,
        'organisation' => true,
        'staff' => true
    ];
}
