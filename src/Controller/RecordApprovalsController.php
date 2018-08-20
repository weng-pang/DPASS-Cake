<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RecordApprovals Controller
 *
 * @property \App\Model\Table\RecordApprovalsTable $RecordApprovals
 *
 * @method \App\Model\Entity\RecordApproval[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecordApprovalsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $recordApprovals = $this->paginate($this->RecordApprovals);

        $this->set(compact('recordApprovals'));
    }

    /**
     * View method
     *
     * @param string|null $id Record Approval id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $recordApproval = $this->RecordApprovals->get($id, [
            'contain' => []
        ]);

        $this->set('recordApproval', $recordApproval);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recordApproval = $this->RecordApprovals->newEntity();
        if ($this->request->is('post')) {
            $recordApproval = $this->RecordApprovals->patchEntity($recordApproval, $this->request->getData());
            if ($this->RecordApprovals->save($recordApproval)) {
                $this->Flash->success(__('The record approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The record approval could not be saved. Please, try again.'));
        }
        $this->set(compact('recordApproval'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Record Approval id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recordApproval = $this->RecordApprovals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $recordApproval = $this->RecordApprovals->patchEntity($recordApproval, $this->request->getData());
            if ($this->RecordApprovals->save($recordApproval)) {
                $this->Flash->success(__('The record approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The record approval could not be saved. Please, try again.'));
        }
        $this->set(compact('recordApproval'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Record Approval id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recordApproval = $this->RecordApprovals->get($id);
        if ($this->RecordApprovals->delete($recordApproval)) {
            $this->Flash->success(__('The record approval has been deleted.'));
        } else {
            $this->Flash->error(__('The record approval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
