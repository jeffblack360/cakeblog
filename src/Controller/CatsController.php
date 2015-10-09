<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cats Controller
 *
 * @property \App\Model\Table\CatsTable $Cats
 */
class CatsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Breeds']
        ];
        
        $this->set('cats', $this->paginate($this->Cats));
        $this->set('_serialize', ['cats']);
    }

    /**
     * View method
     *
     * @param string|null $id Cat id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cat = $this->Cats->get($id, [
            'contain' => ['Breeds']
        ]);
        $this->set('cat', $cat);
        $this->set('_serialize', ['cat']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cat = $this->Cats->newEntity();
        if ($this->request->is('post')) {
            $cat = $this->Cats->patchEntity($cat, $this->request->data);
            if ($this->Cats->save($cat)) {
                $this->Flash->success(__('The cat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cat could not be saved. Please, try again.'));
            }
        }
        $breeds = $this->Cats->Breeds->find('list', ['limit' => 200]);
        $this->set(compact('cat', 'breeds'));
        $this->set('_serialize', ['cat']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cat id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cat = $this->Cats->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cat = $this->Cats->patchEntity($cat, $this->request->data);
            if ($this->Cats->save($cat)) {
                $this->Flash->success(__('The cat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cat could not be saved. Please, try again.'));
            }
        }
        $breeds = $this->Cats->Breeds->find('list', ['limit' => 200]);
        $this->set(compact('cat', 'breeds'));
        $this->set('_serialize', ['cat']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cat id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cat = $this->Cats->get($id);
        if ($this->Cats->delete($cat)) {
            $this->Flash->success(__('The cat has been deleted.'));
        } else {
            $this->Flash->error(__('The cat could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
