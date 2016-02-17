<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Network\Email\Email;
use App\Model\Entity\User;

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
        $this->loadModel('JobFuncs');
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $this->out('UserShell running');
        $this->_sendVerifyEmail();
//        $this->_sendResetEmail();
        $this->out('UserShell complete');
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
    
    /**
    * _sendVerifyEmail() method
    *
    * Process job_funcs records that are new email verifications
    *
    * @return void
    */
    private function _sendVerifyEmail()
    {
        $this->log('Start _verifyEmail', 'info');
        $jobfuncs = $this->JobFuncs->find()
                ->where([
                    'process_name' => 'email',
                    'process_status' => 'new',
                    'func_name' => 'verify',
                ])
                ->order(['created' => 'ASC']);

        foreach ($jobfuncs as $jobfunc) {
            $query = $this->Users->find()
                    ->where(['id' => $jobfunc->func_opt]);
            
            $user = $query->first();
            $this->_sendEmail($user);
        }
        $this->log('End _verifyEmail', 'info');
        return;
    }
    
    /**
    * _sendEmail() method
    *
    * Reusable function to send emails to a user.
    *
    * @return void
    */
    private function _sendEmail(User $user) {
        $this->log(
                'Send verify email to ' .
                'id: ' . $user->id . ' ' .
                'username: ' . $user->username . ' ' .
                'email: ' . $user->email, 'info'
        );
        $email = new Email('default');
        $email->from(['jblackx-findmypet@yahoo.com' => 'FindMyPet.com'])
                ->to('jeff.black@outlook.com')
                ->subject('About')
                ->send('Confirm Registration');
    }

}
