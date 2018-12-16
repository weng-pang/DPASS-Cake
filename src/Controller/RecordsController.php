<?php
namespace App\Controller;

use Cake\Http\Client;

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
        $records = $this->paginate($this->Records);

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
        $record = $this->Records->get($id, [
            'contain' => []
        ]);

        $this->set('record', $record);
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
     * Staff Add method
     *
     * @param string|null $code Access code
     * @param string|null $language Language code
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function staffadd($code = null, $language = null){
        // Configure the language
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
            ->limit(5); //TODO Check to variable setting
        // Fetch the organisation the staff belongs to
        $staff = $this->Records->Staff
            ->find('all',['contain'=>'Organisations'])
            ->where(['id'=> $link->staff_id])
            ->first();
        // checking a GET or POST request
        // A POST request should contain everything a GET with additional works
        if ($this->request->is('post')) { $this->Flash->success('POST Request triggered');
            // TODO POST Request additions
            $postData = $this->request->getData();
            // Process the photo upload
            $photoPresented = false;
            if ($postData['photo']['error'] == UPLOAD_ERR_OK){
                // Get photo information
                $exif_data = (exif_read_data($postData['photo']['tmp_name']));
                $photoType = explode('/',$exif_data['MimeType']);
               // Get a new placeholder for photo
                $photoTable = $this->Records->Scores->Photos;
                $photo = $photoTable->newEntity();
                $photo->create_time = time();
                // Store photo
                if ($photoTable->save($photo)){
                    // Store photo information into system
                    $photo->metadata = serialize($exif_data); // This is an array to string
                    // append the id number into photo filename
                    $photo->photo_path = $link->staff_id."-".$photo->id.".".$photoType[1]; // TODO change to time?
                    // save the photo information again
                    $photo->update_time = time();
                    $photoTable->save($photo);
                } else {
                    //TODO Error creating the photo database entry
                }
                if (!move_uploaded_file($postData['photo']['tmp_name'],ROOT.'/photos/'. $photo->photo_path)){
                    // TODO Error moving the photo
                } else {
                    $this->Flash->success('the photo is stored.');
                    $photoPresented = true;
                }
            }
            // Store Record
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
            // Get Time
            $record->create_time = time();
            $record->update_time = time();
            $record->time = time();
            // Save the record
            if ($this->Records->save($record)){
                $this->Flash->success('the record is stored');
                // "Calculate" the score
                // Giving the initial score
                $score = $this->Records->Scores->newEntity();
                $score->record_id = $record->id;
                $score->manager_id = 10; //TODO Change to dynamic
                $score->score = 50;
                $score->notes = "Added by the System";
                $score->create_time = time();
                $score->update_time = time();
                $this->Records->Scores->save($score);
                // Giving the photo score
                if ($photoPresented){
                    $score = $this->Records->Scores->newEntity();
                    $score->record_id = $record->id;
                    $score->manager_id = 10; //TODO Change to dynamic
                    $score->photos = [$photo];
                    $score->score = 50;
                    $score->notes = "Photo is attached. Added by the System";
                    $score->create_time = time();
                    $score->update_time = time();
                    $this->Records->Scores->save($score);
                } else {

                }
                // Add to DPass REST

                if ($this->findSetting('enable_dpass_rest')==SETTING_ENABLE){
                    $dpassRest = new Client();
                    // Prepare the information
                    $data['id'] = $link->staff_id;
                    $data['dateTime'] = date("Y-m-d H:i:s",$record->time);
                    $data['machineId'] = (int)$this->findSetting('dpass_rest_id'); // This must be a number
                    $data['entryId'] = 0; // Leave them zero
                    $data['portNumber'] = 0;
                    $data['ipAddress'] =
                        $this->request->getEnv('SERVER_ADDR') == '::1' ?
                        '127.0.0.1' :
                        $this->request->getEnv('SERVER_ADDR');
                    $response = $dpassRest->post($this->findSetting('dpass_rest_add_address'),
                        [
                            'key' => $this->findSetting('dpass_rest_key'),
                            'content' => json_encode($data)
                        ]);

                    debug(json_decode($response->getBody()->getContents())); //TODO Remove the debug
                }

            } else {
                //TODO Failed to add a record
            }


        }

        $record = $this->Records->newEntity(); // This is needed to a request is made each request.
        // sending the data to view layer
        $this->set('link',($link));
        $this->set('staff',$staff);
        $this->set('records',($records));
        $this->set('record',$record);

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
