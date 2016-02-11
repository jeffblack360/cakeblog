<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * User shell command.
 */
class UserShell extends Shell
{
    /**
     * initialize() method.
     *
     * @return bool|int Success or error code.
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
    }

    /**
     * show() method.
     *
     * @return bool|int Success or error code.
     */
    public function show()
    {
        if (empty($this->args[0])) {
//            return $this->error('Please enter a username.');
            return $this->_showAll();
        }
        $user = $this->Users->findByUsername($this->args[0])->first();
        $this->out(print_r($user, true));
        
    }
    
    /**
    * _showAll() method
    *
    * Process all users
    *
    * @return void
    */
    protected function _showAll()
    {
        $users = $this->Users->find();
        foreach ($users as $user) {
            $this->log(
                'username: ' . $user->username . ' ' .
                'email: ' . $user->email, 'info'
            );
        }
        return;
    }
}
