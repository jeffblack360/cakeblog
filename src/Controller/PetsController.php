<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pets Controller
 *
 * @property \App\Model\Table\PetsTable $Pets
 */
class PetsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('pets', $this->paginate($this->Pets));
        $this->set('_serialize', ['pets']);
    }

    /**
     * View method
     *
     * @param string|null $id Pet id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pet = $this->Pets->get($id, [
            'contain' => []
        ]);
        $this->set('pet', $pet);
        $this->set('_serialize', ['pet']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pet = $this->Pets->newEntity();
        if ($this->request->is('post')) {
            $pet = $this->Pets->patchEntity($pet, $this->request->data);
            if ($this->Pets->save($pet)) {
                $this->Flash->success(__('The pet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pet could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pet'));
        $this->set('_serialize', ['pet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pet id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pet = $this->Pets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pet = $this->Pets->patchEntity($pet, $this->request->data);
            if ($this->Pets->save($pet)) {
                $this->Flash->success(__('The pet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pet could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pet'));
        $this->set('_serialize', ['pet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pet id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pet = $this->Pets->get($id);
        if ($this->Pets->delete($pet)) {
            $this->Flash->success(__('The pet has been deleted.'));
        } else {
            $this->Flash->error(__('The pet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
