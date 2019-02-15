<?php
namespace App\Controller;

use Cake\I18n\Time;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Core\Configure;

/**
 * Records Controller
 *
 * @property \App\Model\Table\RecordsTable $Records
 *
 * @method \App\Model\Entity\Record[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $records =($this->Records->find('all',[
            'contain' => ['Staff','Scores']
        ]));

        $this->set(compact('records'));
    }

    /**
     * View method
     *
     * @param string|null $id Record id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Records->recursive =
        $record = $this->Records->get($id, [
            'contain' => ['Staff','Scores'],
        ]);
        // Add the Photo access list
        $scoresWithPhotos = $this->Records->Scores->find('all',[
                'conditions' => ['Record_id' => $id],
            ]
        )->contain(['Photos']);

        $session = $this->getRequest()->getSession();
        // Generate a photo file list
        $photosList = array();
        foreach ($scoresWithPhotos as $score){
            foreach ($score->photos as $photo){
                $photosList [$photo->id] = $photo->photo_path;
            }
        }
        // Load the photo list into session
        $session->write('photosList',$photosList);
        $this->set('record', $record);
        $this->set('marks', $this->marks->getMarks());
        $this->set('mapbox', Configure::read('Mapbox'));
        $this->set('scoresWithPhotos',$scoresWithPhotos);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $record = $this->Records->newEntity();
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $formData['staff_id'] = 500;
            debug($formData);
            $record = $this->Records->patchEntity($record, $formData); debug($record);
            if ($this->Records->save($record)) {
                $this->Flash->success(__('The record has been saved.'));

//                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The record could not be saved. Please, try again.'));
        }
        $staff = $this->Records->Staff->find('list', ['limit' => 200]);
        $this->set(compact('record','staff'));
    }

    /**
     * Staff Add method
     *
     * @param string|null $code Access code
     * @param string|null $language Language code
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function staffadd($code = null, $language = null){
        // Change the layout
        $this->viewBuilder()->setLayout('attendance_record');
        // Configure the language
        if (!is_null($language)){
            $this->changeLanguage($language);
        }
        // Fetching the link access code and staff profile
        $record = $this->Records->newEntity();
        $link = $this->Records->Staff->Links
            ->find('all')
            ->where(['link' => $code])
            ->firstOrFail();
        $record->staff_id = $link->staff_id;
        // Fetching the latest attendance records
        $records = $this->Records
            ->find('all')
            ->where(['staff_id'=> $link->staff_id])
            ->order(['time'=>'DESC'])
            ->limit((int)$this->settings->getSettings()->staffadd_view_limit);
        // Fetch the organisation the staff belongs to
        $staff = $this->Records->Staff
            ->find('all',['contain'=>'Organisations'])
            ->where(['id'=> $link->staff_id])
            ->first();
        // checking a GET or POST request
        // A POST request should contain everything a GET with additional works
        if ($this->request->is('post')) {
            // TODO POST Request additions
            $postData = $this->request->getData();
            // Prepare the record here
            // Get Environment Variables
            if (is_null($this->request->getEnv('HTTP_CF_CONNECTING_IP'))){
                $record->http_cf_connecting_ip = $this->request->getEnv('REMOTE_ADDR');
            } else {
                $record->http_cf_connecting_ip = $this->request->getEnv('HTTP_CF_CONNECTING_IP');
            }
            $record->http_cf_ray = $this->request->getEnv('HTTP_CF_RAY');
            $record->http_cookie = $this->request->getEnv('HTTP_COOKIE');
            $record->http_user_agent = $this->request->getEnv('HTTP_USER_AGENT');
            // Get Location coordinates
            $record->longitude = $postData['longitude'];
            $record->latitude = $postData['latitude'];
            $record->accuracy = $postData['accuracy'];
            if ($record->accuracy > 0) {
                $locationPresented = true;
            } else {
                $locationPresented = false;
            }
            // Append Machine ID
            $record->machine_code = (int)$this->settings->getSettings()->dpass_rest_code;
            // Get Time
            $record->time = Time::now();
            // Process the photo upload
            $photoPresented = false;
            if ($postData['photo']['error'] == UPLOAD_ERR_OK){
                // Get photo information
                $exif_data = (exif_read_data($postData['photo']['tmp_name']));
                $photoType = explode('/',$exif_data['MimeType']);
               // Get a new placeholder for photo
                $photoTable = $this->Records->Scores->Photos;
                $photo = $photoTable->newEntity();
                // Store photo
                if ($photoTable->save($photo)){
                    // Store photo information into system
                    $photo->metadata = serialize($exif_data); // This is an array to string
                    // append the id number into photo filename
                    $photo->photo_path = $link->staff_id."-".$photo->id.".".$photoType[1]; // TODO change to time?
                    // save the photo information again
                    $photoTable->save($photo);
                } else {
                    //TODO Error creating the photo database entry
                }
                if (!move_uploaded_file($postData['photo']['tmp_name'],PHOTOS_DIR . $photo->photo_path)){
                    // TODO Error moving the photo
                } else {
                    $photoPresented = true;
                }
            } else {
                //TODO Error uploading photo to the system
            }
            // Save the record
            if ($this->Records->save($record)){
                // "Calculate" the score
                // Giving the initial score //TODO see https://trello.com/c/7yiiJ79c
                $this->giveScore($record,'staff_add_record',"Record is added.");
                // Giving the photo score, note this is a second one, not repeating.
                if ($photoPresented){
                    $theScore = $this->giveScore($record,'staff_add_photo',"Photo is presented.");
                    // Establish a link between the Photo and the Score
                    $photo->scores = [$theScore];
                    $photoTable->save($photo);
                }
                // Giving the location score.
                if ($locationPresented){
                    $this->giveScore($record,'staff_add_location',"Location is presented.");
                }
                // Add to DPass REST
                if ($this->settings->getSettings()->dpass_rest_enabled == SETTING_ENABLE){
                    $this->Records->addRestRecords([$record]);
                }
                if (is_null($language)){
                    $this->redirect(['controller'=>'Records','action'=>'staffaddCompleted',$code]);
                } else {
                    $this->redirect(['controller'=>'Records','action'=>'staffaddCompleted',$code,$language]);
                }
            } else {
                //TODO Failed to add a record
            }
        }
        // sending the data to view layer
        $this->set('link',($link));
        $this->set('staff',$staff);
        $this->set('records',($records));
        $this->set('record',$record);
        $this->set('recordLimit',(int)$this->settings->getSettings()->staffadd_view_limit);
        $this->set('waitTime',(int)$this->settings->getSettings()->staffadd_wait_time);
    }

    public function staffaddCompleted($code = null, $language = null){
        // Change the layout
        $this->viewBuilder()->setLayout('attendance_record');
        // Configure the language
        if (!is_null($language)){
            $this->changeLanguage($language);
        }
        // Re-fetching things here
        $link = $this->Records->Staff->Links
            ->find('all')
            ->where(['link' => $code])
            ->firstOrFail();
        // Fetching the latest attendance records
        $viewLimit = (int)$this->settings->getSettings()->staffadd_view_limit + 1;  // Adding one more to highlight the latest one
        $records = $this->Records
            ->find('all')
            ->where(['staff_id'=> $link->staff_id])
            ->order(['time'=>'DESC'])
            ->limit($viewLimit);
        // Fetch the organisation the staff belongs to
        $staff = $this->Records->Staff
            ->find('all',['contain'=>'Organisations'])
            ->where(['id'=> $link->staff_id])
            ->first();

        // sending the data to view layer
        $this->set('link',($link));
        $this->set('staff',$staff);
        $this->set('records',($records));
        $this->set('recordLimit',$viewLimit);
    }

    /**
     * RESTful Record add method
     *
     * Records may be added via the RESTful Channel
     * Pathway to access: ../api/records/add
     * Data to be transmitted as form data.
     *
     * @return \Cake\Http\Response|void
     */
    public function restAdd(){
        $this->viewBuilder()->setClassName('Json');
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            // Check for API key
            if (array_key_exists('key',$formData) && $this->checkKey($formData['key'])){
                $content = json_decode($formData['content']);
                // Record Validation
                $itemValid = true;
                $i = 0;
                foreach ($content as $item){
                    $record['staff_id'] = $item->id;
                    $record['http_cf_connecting_ip'] = $item->ipAddress;
                    $record['machine_code'] = $item->machineId;
                    // Get Time
                    $record['time'] = new Time($item->dateTime);
                    $record['accuracy'] = 100;
                    $dataCheck = $this->Records->newEntity($record);
                    $records[] = $dataCheck;
                    if ($dataCheck->getErrors()){
                        $itemValid = false;
                        $errorMessage[$i] = $dataCheck->getErrors();
                    }
                    try{ // Staff Id Check
                        $this->Records->Staff->get($item->id);
                    } catch (RecordNotFoundException $e){
                        $itemValid = false;
                        $errorMessage[$i]['staff_id'] = $item->id . ' is missing from database';
                    }
                    $i++;
                }
                if ($itemValid) {
                    // add record accordingly
                    foreach ($records as $item){
                        $this->Records->save($item);
                        // return the record id number
                        $results[]['transactionId'] = $item->id;
                    }
                    // Add to DPass REST
                    if ($this->settings->getSettings()->dpass_rest_enabled == SETTING_ENABLE){
                        $this->Records->addRestRecords($records);
                    }
                } else {
                    $errorMessage['error'] = 'One or more of the records are incorrect, or the JSON syntax is wrong';
                    $this->response = $this->response->withStatus(400);
                }
            } else {
                // API Key is invalid
                $errorMessage['error'] = $this->keyError;
            }
        } else {
            $errorMessage['error'] = 'Method not allowed';
            $this->response = $this->response->withStatus(405);
        }
        if (isset($errorMessage)){
            // Error messages to be shown here
            $this->set('json',json_encode($errorMessage));
        } else {
            // The record is processed successfully
            $this->set('json',json_encode($results));
        }
    }

    /**
     * giveScore method
     *
     * Score of a record will be added according to the score name,
     * the method then fetch the set score value to add into the scores table.
     *
     * Note this method resembles the system into a person making the score.
     *
     * @param \App\Model\Table\RecordsTable $record
     * @param String $scoreName
     * @param String $note
     * @return \App\Model\Table\ScoresTable $score
     */
    private function giveScore($record, $scoreName, $note){
        $score = $this->Records->Scores->newEntity();
        $score->record_id = $record->id;
        $score->manager_id = (int)$this->settings->getSettings()->manager_id;
        $score->score = $this->marks->getMarks()->$scoreName;
        $score->notes = $note;
        $this->Records->Scores->save($score);
        return $score;
    }

    /**
     * Edit method
     *
     * @param string|null $id Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $record = $this->Records->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $record = $this->Records->patchEntity($record, $this->request->getData());
            if ($this->Records->save($record)) {
                $this->Flash->success(__('The record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The record could not be saved. Please, try again.'));
        }
        $this->set(compact('record'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $record = $this->Records->get($id);
        if ($this->Records->delete($record)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
