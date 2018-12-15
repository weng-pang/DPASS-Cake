<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganisationsStaff Model
 *
 * @property \App\Model\Table\OrganisationsTable|\Cake\ORM\Association\BelongsTo $Organisations
 * @property \App\Model\Table\StaffTable|\Cake\ORM\Association\BelongsTo $Staff
 *
 * @method \App\Model\Entity\OrganisationsStaff get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganisationsStaff newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganisationsStaff[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganisationsStaff|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganisationsStaff|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganisationsStaff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganisationsStaff[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganisationsStaff findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganisationsStaffTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('organisations_staff');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Organisations', [
            'foreignKey' => 'organisation_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Staff', [
            'foreignKey' => 'staff_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('create_time')
            ->requirePresence('create_time', 'create')
            ->notEmpty('create_time');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['organisation_id'], 'Organisations'));
        $rules->add($rules->existsIn(['staff_id'], 'Staff'));

        return $rules;
    }
}
