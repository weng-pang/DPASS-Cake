<?php
namespace App\Controller;

use App\Controller\AppController;


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
        $link = $this->Records->Staff->Links
            ->find('all')
            ->where(['link' => $code])
            ->firstOrFail();

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
        if ($this->request->is('post')) {
            // TODO POST Request additions

            // Get Environment Variables
        }
        $record = $this->Records->newEntity();
        $record->staff_id = $link->staff_id;
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
