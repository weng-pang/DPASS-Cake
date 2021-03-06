<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @property \App\Model\Table\LanguagesTable|\Cake\ORM\Association\BelongsTo $Languages
 * @property \App\Model\Table\ManagersTable|\Cake\ORM\Association\BelongsTo $Managers
 *
 * @method \App\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 */
class SettingsTable extends Table
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

        $this->setTable('settings');
        $this->setDisplayField('keyword');
        $this->setPrimaryKey('id');

        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id'
        ]);
        $this->belongsTo('Managers', [
            'foreignKey' => 'manager_id'
        ]);

        $this->addBehavior('Timestamp',[
            'events' => [
                'Model.beforeSave' => [
                    'create_time' => 'new',
                    'update_time' => 'always',
                ],
            ],
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
            ->scalar('keyword')
            ->maxLength('keyword', 50)
            ->requirePresence('keyword', 'create')
            ->notEmpty('keyword')
            ->add('keyword', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('enabled')
            ->requirePresence('enabled', 'create')
            ->notEmpty('enabled');

        $validator
            ->scalar('content')
            ->maxLength('content', 5000)
            ->allowEmpty('content');

        $validator
            ->integer('dpass_rest_enabled')
            ->requirePresence('enabled', 'create')
            ->allowEmpty('dpass_rest_enabled');

        $validator
            ->integer('dpass_rest_code')
            ->allowEmpty('dpass_rest_code');

        $validator
            ->scalar('dpass_rest_add_address')
            ->maxLength('dpass_rest_add_address', 100)
            ->allowEmpty('dpass_rest_add_address');

        $validator
            ->scalar('dpass_rest_key')
            ->maxLength('dpass_rest_key', 100)
            ->allowEmpty('dpass_rest_key');

        $validator
            ->integer('staffadd_wait_time')
            ->allowEmpty('staffadd_wait_time');

        $validator
            ->integer('staffadd_view_limit')
            ->allowEmpty('staffadd_view_limit');

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
        $rules->add($rules->isUnique(['keyword']));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['manager_id'], 'Managers'));

        return $rules;
    }

    /**
     * Find Setting Method
     * The Settings from the database is obtained.
     * The first enabled Settings set to be returned
     *
     * @return array|\Cake\Datasource\EntityInterface|null
     */
    public function getSettings(){
        return $this->find('all')->where(['enabled' => true])->first();
    }
}
