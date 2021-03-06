<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\JobFunc;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
//                 $event = new Event('Model.Users.afterAdd', $this, [
//                    'user' => $user
//                ]);
//                $this->eventManager()->dispatch($event);
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    
    /**
    * beforeFilter method
    *
    * @return void
    */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);        
        $this->Auth->allow(['add','logout','verify','reset']);
        $this->set('options', ['admin' => 'Admin', 'author' => 'Author']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user', 'options']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
    * Login method
    *
    * @return void
    */
    public function login() 
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect('/');
            }
            $this->Flash->set(__('Invalid username or password, try again'),[
                'element' => 'error'
            ]);
        }
    }

   /**
    * Logout method
    *
    * @return void
    */
    public function logout() 
    {
        return $this->redirect($this->Auth->logout());
    }
    
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
    
    /**
     * Verify method
     *
     * Verify a user registration
     * 
     * @param string|null $id Verification hash.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function verify()
    {
        $hash = $this->request->param('hash');
        $this->Users->verifyUser($hash);
        
        // 7. display page showing user is verified
    }    
    
    /**
     * reset
     *
     * Reset UserName or Password
     * 
     * @param string|null $id 
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function reset()
    {
        $do = $this->request->query('do');
        $this->set('reset', $do);
    }
}
