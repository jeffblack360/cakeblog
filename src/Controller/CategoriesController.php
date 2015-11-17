<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Cache\Cache;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
{
    /**
     * cacheCategories method
     * 
     * Attempt to read Categories from Cache. Write result to Cache when not 
     * found.
     *
     * @return \App\Model\Table\CategoriesTable $Categories
     */
    private function cacheCategories()
    {
        return $this->Categories->cacheCategories();
        
//        $categories = $this->Categories->find();
//        return $categories->cache('categories');
        
//        if (($categories = Cache::read('categories')) === false) {
//            $categories = $this->Categories;
//            Cache::write('categories', $categories);
//        }
//        return $categories;
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        // Tell the paginate component that we want to return ParentCategories 
        // associations.
        $this->paginate = [
            'contain' => ['ParentCategories']
        ];

//        $categories = $this->Categories->find()
//            ->order(['lft' => 'ASC']);

        // Get the sort request -- if there is one.
        $sortreq = $this->request->query['sort'];
        
        // Does the user wish to sort things?
        if ($sortreq === null) {
            
            // Leverage the query cache feature. Return the resultset from
            // the cache if it's there, otherwise access the database
            // and cache the result for future requests.
            $this->set('categories', $this->paginate($this->Categories->query()->cache('recent-categories')));            
        } else {
            
            // User wants to sort the categories. We'll default to lft sort.
            $sortdir = 'lft-categories';
            
            if ($sortreq === 'rght') {
                $sortdir = 'rght-categories';
            }
            
            $this->set('categories', $this->paginate($this->Categories->query()->cache($sortdir)));                
            
        }
            
        $this->set('_serialize', ['categories']);
        
    }
    public function index2()
    {
        $this->paginate = [
            'contain' => ['ParentCategories']
        ];
        
//        $q = $this->Categories->find()
//                           ->order(['lft' => 'ASC'])->execute();

//        $q = $this->Categories->query();
//        $this->set('categories', $this->paginate($this->Categories));
//        $this->set('categories', $this->paginate($this->cacheCategories()));
//        $this->set('categories', $this->paginate($q->cache('recent-categories')));
//        $categories->execute();
                
        $this->set('categories', $this->paginate($this->Categories->query()->cache('recent-categories')));
//        $this->set('categories', $this->paginate());
        $this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'Articles', 'ChildCategories']
        ]);
        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
    * moveUp method
    *
    * @param string|null $id Category id.
    * @return void Redirects to index.
    */
    public function moveUp($id = null)
    {
        // Only permit post and put
        $this->request->allowMethod(['post', 'put']);
        
        // Retrieve a category item
        $category = $this->Categories->get($id);
        
        // Attempt a moveUp operation
        if ($this->Categories->moveUp($category)) {
            $this->Flash->success('The category has been moved Up.');
        } else {
            $this->Flash->error('The category could not be moved up. Please, try again.');
        }
        
        // And return...
        return $this->redirect($this->referer(['action' => 'index']));        
    }
    
    /**
    * moveDown method
    *
    * @param string|null $id Category id.
    * @return void Redirects to index.
    */
    public function moveDown($id = null)
    {
        // Only permit post and put
        $this->request->allowMethod(['post', 'put']);
        
        // Retrieve a category item
        $category = $this->Categories->get($id);
        
        // Attempt a moveDown operation
        if ($this->Categories->moveDown($category)) {
            $this->Flash->success('The category has been moved down.');
        } else {
            $this->Flash->error('The category could not be moved down. Please, try again.');
        }
        
        // And return...
        return $this->redirect($this->referer(['action' => 'index']));        
    }
}
