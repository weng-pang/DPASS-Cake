<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Staffs Model
 *
 * @method \App\Model\Entity\Staff get($primaryKey, $options = [])
 * @method \App\Model\Entity\Staff newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Staff[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Staff|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Staff[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Staff findOrCreate($search, callable $callback = null, $options = [])
 */
class StaffsTable extends Table
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

        $this->setTable('staffs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('name2')
            ->maxLength('name2', 50)
            ->allowEmpty('name2');

        $validator
            ->time('checkin')
            ->requirePresence('checkin', 'create')
            ->notEmpty('checkin');

        $validator
            ->time('checkout')
            ->requirePresence('checkout', 'create')
            ->notEmpty('checkout');

        $validator
            ->integer('lunch')
            ->requirePresence('lunch', 'create')
            ->notEmpty('lunch');

        $validator
            ->integer('overtime')
            ->requirePresence('overtime', 'create')
            ->notEmpty('overtime');

        $validator
            ->requirePresence('repeatedrange', 'create')
            ->notEmpty('repeatedrange');

        $validator
            ->requirePresence('overtimeapproval', 'create')
            ->notEmpty('overtimeapproval');

        return $validator;
    }
}
