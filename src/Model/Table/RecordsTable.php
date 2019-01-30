<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Records Model
 *
 * @property \App\Model\Table\StaffTable|\Cake\ORM\Association\BelongsTo $Staff
 * @property \App\Model\Table\ScoresTable|\Cake\ORM\Association\HasMany $Scores
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
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Staff', [
            'foreignKey' => 'staff_id'
        ]);
        $this->hasMany('Scores', [
            'foreignKey' => 'record_id'
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
            ->integer('machine_code')
            ->allowEmpty('machine_code');

        $validator
            ->integer('rest_serial')
            ->allowEmpty('rest_serial');

        $validator
            ->decimal('longitude')
            ->allowEmpty('longitude');

        $validator
            ->decimal('latitude')
            ->allowEmpty('latitude');

        $validator
            ->decimal('accuracy')
            ->allowEmpty('accuracy');

        $validator
            ->dateTime('time')
            ->allowEmpty('time');

        $validator
            ->scalar('additional_data')
            ->maxLength('additional_data', 1000)
            ->allowEmpty('additional_data');

        $validator
            ->scalar('http_user_agent')
            ->maxLength('http_user_agent', 200)
            ->allowEmpty('http_user_agent');

        $validator
            ->scalar('http_cf_ray')
            ->maxLength('http_cf_ray', 100)
            ->allowEmpty('http_cf_ray');

        $validator
            ->scalar('http_cf_connecting_ip')
            ->maxLength('http_cf_connecting_ip', 45)
            ->allowEmpty('http_cf_connecting_ip');

        $validator
            ->scalar('http_cookie')
            ->maxLength('http_cookie', 1000)
            ->allowEmpty('http_cookie');

        $validator
            ->dateTime('create_time')
            ->allowEmpty('create_time');

        $validator
            ->dateTime('update_time')
            ->allowEmpty('update_time');

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
        $rules->add($rules->existsIn(['staff_id'], 'Staff'));

        return $rules;
    }
}
