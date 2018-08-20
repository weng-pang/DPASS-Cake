<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RecordApprovals Model
 *
 * @method \App\Model\Entity\RecordApproval get($primaryKey, $options = [])
 * @method \App\Model\Entity\RecordApproval newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RecordApproval[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RecordApproval|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RecordApproval|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RecordApproval patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RecordApproval[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RecordApproval findOrCreate($search, callable $callback = null, $options = [])
 */
class RecordApprovalsTable extends Table
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

        $this->setTable('record_approvals');
        $this->setDisplayField('serial');
        $this->setPrimaryKey('serial');
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
            ->integer('serial')
            ->allowEmpty('serial', 'create');

        $validator
            ->integer('record_serial')
            ->requirePresence('record_serial', 'create')
            ->notEmpty('record_serial');

        $validator
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->requirePresence('power', 'create')
            ->notEmpty('power');

        $validator
            ->dateTime('datetime')
            ->requirePresence('datetime', 'create')
            ->notEmpty('datetime');

        $validator
            ->boolean('revoked')
            ->requirePresence('revoked', 'create')
            ->notEmpty('revoked');

        $validator
            ->dateTime('update')
            ->requirePresence('update', 'create')
            ->notEmpty('update');

        return $validator;
    }
}
