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
            return $this->error('Please enter a username.');
        }
        $user = $this->Users->findByUsername($this->args[0])->first();
        $this->out(print_r($user, true));
        
    }
}
