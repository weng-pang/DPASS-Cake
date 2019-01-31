<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Client;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
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
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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
            ->integer('machine_code')
            ->naturalNumber('machine_code','Machine id should be a positive number')
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
            ->ip('http_cf_connecting_ip','IP Format is incorrect')
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

    /**
     * addRestRecord method
     *
     * This is a fallback and backup measure for this system
     * By using this method, the record is 'copied' into the DPASS REST system
     *
     * Note this method does not copy scores into DPASS REST.
     * Note also this method does not check redundant record at DPASS REST,
     * it simply copies records only. Please use with caution.
     *
     * @param array $records
     */
    public function addRestRecords(array $records){
        if (sizeof($records) > 0) {
            $dpassRest = new Client();
            $request = Router::getRequest(); // https://stackoverflow.com/a/21139714
            $settings = TableRegistry::getTableLocator()->get('Settings'); https://book.cakephp.org/3.0/en/orm.html#quick-example
            // Prepare the information
            foreach ($records as $record){
                $data['id'] = $record->staff_id;
                $data['dateTime'] = $record->time->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $data['machineId'] = $record->machine_code; // This must be a number
                $data['entryId'] = 0; // Leave them zero
                $data['portNumber'] = 0;
                $data['ipAddress'] = '0.0.0.0'; // Default IP Address value
                if (!is_null($request)){
                    $data['ipAddress'] = // The DPASS Rest accepts ipv4 address only
                        $request->getEnv('SERVER_ADDR') == '::1' ?
                            '127.0.0.1' :
                            $request->getEnv('SERVER_ADDR');
                }
                $content[] = $data;
            }
            $response = $dpassRest->post($settings->getSetting('dpass_rest_add_address'),
                [
                    'key' => $settings->getSetting('dpass_rest_key'),
                    'content' => json_encode($content)
                ]);
            $jsonResponse = json_decode($response->getBody()->getContents());

            $i = 0;
            foreach ($records as $record) {
                if (isset($jsonResponse->error)){
                    $record->additional_data .=
                        'DPASS REST Error in: '. $jsonResponse->error->procedure .';'. $jsonResponse->error->text;
                } else {
                    $record->rest_serial = $jsonResponse[$i++]->transactionId;
                }
                $this->save($record);
            }
        }
        // It will not do anything if there is nothing to put in
    }
}
