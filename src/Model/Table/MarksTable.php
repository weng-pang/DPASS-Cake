<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Marks Model
 *
 * @method \App\Model\Entity\Mark get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mark newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mark[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mark|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mark|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mark patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mark[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mark findOrCreate($search, callable $callback = null, $options = [])
 */
class MarksTable extends Table
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

        $this->setTable('marks');
        $this->setDisplayField('id');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('keyword')
            ->maxLength('keyword', 50)
            ->requirePresence('keyword', 'create')
            ->notEmpty('keyword');

        $validator
            ->boolean('enabled')
            ->requirePresence('enabled', 'create')
            ->notEmpty('enabled');

        $validator
            ->integer('pass_mark')
            ->requirePresence('pass_mark', 'create')
            ->notEmpty('pass_mark');

        $validator
            ->integer('staff_add_record')
            ->requirePresence('staff_add_record', 'create')
            ->notEmpty('staff_add_record');

        $validator
            ->integer('staff_add_location')
            ->requirePresence('staff_add_location', 'create')
            ->notEmpty('staff_add_location');

        $validator
            ->integer('staff_add_photo')
            ->requirePresence('staff_add_photo', 'create')
            ->notEmpty('staff_add_photo');

        $validator
            ->integer('mark')
            ->requirePresence('mark', 'create')
            ->notEmpty('mark');

        $validator
            ->dateTime('create_time')
            ->requirePresence('create_time', 'create')
            ->notEmpty('create_time');

        $validator
            ->dateTime('update_time')
            ->requirePresence('update_time', 'create')
            ->notEmpty('update_time');

        return $validator;
    }

    /**
     * Find Marks Method
     * The Marks from the database is obtained.
     * The first enabled Settings set to be returned
     *
     * @return array|\Cake\Datasource\EntityInterface|null
     */
    public function getMarks(){
        return $this->find('all')->where(['enabled' => true])->first();
    }
}
