<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PetTypes Controller
 *
 * @property \App\Model\Table\PetTypesTable $PetTypes
 */
class PetTypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('petTypes', $this->paginate($this->PetTypes));
        $this->set('_serialize', ['petTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Pet Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $petType = $this->PetTypes->get($id, [
            'contain' => []
        ]);
        $this->set('petType', $petType);
        $this->set('_serialize', ['petType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $petType = $this->PetTypes->newEntity();
        if ($this->request->is('post')) {
            $petType = $this->PetTypes->patchEntity($petType, $this->request->data);
            if ($this->PetTypes->save($petType)) {
                $this->Flash->success(__('The pet type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pet type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('petType'));
        $this->set('_serialize', ['petType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pet Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $petType = $this->PetTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $petType = $this->PetTypes->patchEntity($petType, $this->request->data);
            if ($this->PetTypes->save($petType)) {
                $this->Flash->success(__('The pet type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pet type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('petType'));
        $this->set('_serialize', ['petType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pet Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $petType = $this->PetTypes->get($id);
        if ($this->PetTypes->delete($petType)) {
            $this->Flash->success(__('The pet type has been deleted.'));
        } else {
            $this->Flash->error(__('The pet type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
