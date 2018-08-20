<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RecordStatus Controller
 *
 * @property \App\Model\Table\RecordStatusTable $RecordStatus
 *
 * @method \App\Model\Entity\RecordStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecordStatusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $recordStatus = $this->paginate($this->RecordStatus);

        $this->set(compact('recordStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Record Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $recordStatus = $this->RecordStatus->get($id, [
            'contain' => []
        ]);

        $this->set('recordStatus', $recordStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recordStatus = $this->RecordStatus->newEntity();
        if ($this->request->is('post')) {
            $recordStatus = $this->RecordStatus->patchEntity($recordStatus, $this->request->getData());
            if ($this->RecordStatus->save($recordStatus)) {
                $this->Flash->success(__('The record status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The record status could not be saved. Please, try again.'));
        }
        $this->set(compact('recordStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Record Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recordStatus = $this->RecordStatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $recordStatus = $this->RecordStatus->patchEntity($recordStatus, $this->request->getData());
            if ($this->RecordStatus->save($recordStatus)) {
                $this->Flash->success(__('The record status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The record status could not be saved. Please, try again.'));
        }
        $this->set(compact('recordStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Record Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recordStatus = $this->RecordStatus->get($id);
        if ($this->RecordStatus->delete($recordStatus)) {
            $this->Flash->success(__('The record status has been deleted.'));
        } else {
            $this->Flash->error(__('The record status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
