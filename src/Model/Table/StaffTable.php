<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Staff Model
 *
 * @property \App\Model\Table\LinksTable|\Cake\ORM\Association\HasMany $Links
 * @property |\Cake\ORM\Association\HasMany $Records
 * @property |\Cake\ORM\Association\BelongsToMany $Organisations
 *
 * @method \App\Model\Entity\Staff get($primaryKey, $options = [])
 * @method \App\Model\Entity\Staff newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Staff[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Staff|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Staff[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Staff findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StaffTable extends Table
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

        $this->setTable('staff');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Links', [
            'foreignKey' => 'staff_id'
        ]);
        $this->hasMany('Records', [
            'foreignKey' => 'staff_id'
        ]);
        $this->belongsToMany('Organisations', [
            'foreignKey' => 'staff_id',
            'targetForeignKey' => 'organisation_id',
            'joinTable' => 'organisations_staff'
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
            ->scalar('surname')
            ->maxLength('surname', 100)
            ->allowEmpty('surname');

        $validator
            ->scalar('given_names')
            ->maxLength('given_names', 100)
            ->allowEmpty('given_names');

        $validator
            ->time('start_time')
            ->allowEmpty('start_time');

        $validator
            ->time('end_time')
            ->allowEmpty('end_time');

        $validator
            ->decimal('monthly_wage')
            ->allowEmpty('monthly_wage');

        $validator
            ->decimal('hourly_wage')
            ->allowEmpty('hourly_wage');

        $validator
            ->allowEmpty('status');

        $validator
            ->dateTime('update_time')
            ->allowEmpty('update_time');

        $validator
            ->dateTime('create_time')
            ->allowEmpty('create_time');

        return $validator;
    }
}
