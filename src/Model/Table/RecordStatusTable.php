<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RecordStatus Model
 *
 * @method \App\Model\Entity\RecordStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\RecordStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RecordStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RecordStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RecordStatus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RecordStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RecordStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RecordStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class RecordStatusTable extends Table
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

        $this->setTable('record_status');
        $this->setDisplayField('serial');
        $this->setPrimaryKey(['serial', 'status']);
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
            ->allowEmpty('status', 'create');

        $validator
            ->integer('new_serial')
            ->requirePresence('new_serial', 'create')
            ->notEmpty('new_serial');

        return $validator;
    }
}
