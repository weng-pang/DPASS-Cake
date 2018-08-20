<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Records Model
 *
 * @method \App\Model\Entity\Record get($primaryKey, $options = [])
 * @method \App\Model\Entity\Record newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Record[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Record|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Record|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Record patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Record[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Record findOrCreate($search, callable $callback = null, $options = [])
 */
class RecordsTable extends Table
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

        $this->setTable('records');
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
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->dateTime('datetime')
            ->requirePresence('datetime', 'create')
            ->notEmpty('datetime');

        $validator
            ->requirePresence('machineid', 'create')
            ->notEmpty('machineid');

        $validator
            ->requirePresence('entryid', 'create')
            ->notEmpty('entryid');

        $validator
            ->scalar('ipaddress')
            ->maxLength('ipaddress', 15)
            ->requirePresence('ipaddress', 'create')
            ->notEmpty('ipaddress');

        $validator
            ->requirePresence('portnumber', 'create')
            ->notEmpty('portnumber');

        $validator
            ->dateTime('update')
            ->requirePresence('update', 'create')
            ->notEmpty('update');

        $validator
            ->scalar('key')
            ->maxLength('key', 64)
            ->requirePresence('key', 'create')
            ->notEmpty('key');

        $validator
            ->boolean('revoked')
            ->requirePresence('revoked', 'create')
            ->notEmpty('revoked');

        return $validator;
    }
}
