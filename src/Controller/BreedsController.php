<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Breeds Controller
 *
 * @property \App\Model\Table\BreedsTable $Breeds
 */
class BreedsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('breeds', $this->paginate($this->Breeds));
        $this->set('_serialize', ['breeds']);
    }

    /**
     * View method
     *
     * @param string|null $id Breed id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $breed = $this->Breeds->get($id, [
            'contain' => ['Cats']
        ]);
        $this->set('breed', $breed);
        $this->set('_serialize', ['breed']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $breed = $this->Breeds->newEntity();
        if ($this->request->is('post')) {
            $breed = $this->Breeds->patchEntity($breed, $this->request->data);
            if ($this->Breeds->save($breed)) {
                $this->Flash->success(__('The breed has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The breed could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('breed'));
        $this->set('_serialize', ['breed']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Breed id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $breed = $this->Breeds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $breed = $this->Breeds->patchEntity($breed, $this->request->data);
            if ($this->Breeds->save($breed)) {
                $this->Flash->success(__('The breed has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The breed could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('breed'));
        $this->set('_serialize', ['breed']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Breed id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $breed = $this->Breeds->get($id);
        if ($this->Breeds->delete($breed)) {
            $this->Flash->success(__('The breed has been deleted.'));
        } else {
            $this->Flash->error(__('The breed could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
