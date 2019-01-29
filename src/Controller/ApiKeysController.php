<?php
namespace App\Controller;

/**
 * ApiKeys Controller
 *
 * @property \App\Model\Table\ApiKeysTable $ApiKeys
 *
 * @method \App\Model\Entity\ApiKey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiKeysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $apiKeys = $this->paginate($this->ApiKeys);

        $this->set(compact('apiKeys'));
    }

    /**
     * View method
     *
     * @param string|null $id Api Key id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apiKey = $this->ApiKeys->get($id, [
            'contain' => []
        ]);

        $this->set('apiKey', $apiKey);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apiKey = $this->ApiKeys->newEntity();
        if ($this->request->is('post')) {
            $apiKey = $this->ApiKeys->patchEntity($apiKey, $this->request->getData());
            if ($this->ApiKeys->save($apiKey)) {
                $this->Flash->success(__('The api key has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The api key could not be saved. Please, try again.'));
        }
        $this->set(compact('apiKey'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Api Key id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $apiKey = $this->ApiKeys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $apiKey = $this->ApiKeys->patchEntity($apiKey, $this->request->getData());
            if ($this->ApiKeys->save($apiKey)) {
                $this->Flash->success(__('The api key has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The api key could not be saved. Please, try again.'));
        }
        $this->set(compact('apiKey'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Api Key id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $apiKey = $this->ApiKeys->get($id);
        if ($this->ApiKeys->delete($apiKey)) {
            $this->Flash->success(__('The api key has been deleted.'));
        } else {
            $this->Flash->error(__('The api key could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

