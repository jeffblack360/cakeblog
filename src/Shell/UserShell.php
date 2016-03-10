<?php
namespace App\Shell;

use Cake\Core\Configure;
use Cake\Console\Shell;
use Cake\Network\Email\Email;
//use Cake\Utility\Security;
use App\Model\Entity\JobFunc;
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
//        $this->JobFuncs->expireVerifyEmail();
        $this->_sendVerifyEmail();
        $this->_sendResetEmail();
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
    }
    
    /**
    * _sendVerifyEmail() method
    *
    * Process job_funcs records classified as new registration verifications
    *
    * @return void
    */
    private function _sendVerifyEmail()
    {
        $jobfuncs = $this->JobFuncs->getVerifyEmailJobs();
        
        // Send verify registration email for each record
        foreach ($jobfuncs as $jobfunc) {
            $query = $this->Users->find()
                    ->where(['id' => $jobfunc->func_opt]);
            $user = $query->first();
            $this->_sendEmail($jobfunc, $user);
            $this->JobFuncs->updateVerifyJobSent($jobfunc);
        }
        
        $this->log('End _sendVerifyEmail', 'info');
    }

    /**
    * _sendResetEmail() method
    *
    * Process job_funcs records classified as reset email requests
    *
    * @return void
    */
    private function _sendResetEmail()
    {
        $jobfuncs = $this->JobFuncs->getVerifyEmailJobs();
        
        // Send verify registration email for each record
        foreach ($jobfuncs as $jobfunc) {
            $query = $this->Users->find()
                    ->where(['id' => $jobfunc->func_opt]);
            $user = $query->first();
            $this->_sendEmail($jobfunc, $user);
            $this->JobFuncs->updateVerifyJobSent($jobfunc);
        }
        
        $this->log('End _sendVerifyEmail', 'info');
    }
    
   /**
    * _sendEmail() method
    * 
    * Reusable function for sending user emails
    * 
    * @return void
    */
    private function _sendEmail(JobFunc $jobfunc, User $user) {
        $this->log(
                'Send verify email to ' .
                'id: ' . $user->id . ' ' .
                'username: ' . $user->username . ' ' .
                'email: ' . $user->email . ' ' .
                'func_data: ' . $jobfunc->func_data, 'info'
        );

        if (Configure::read('debug') && Configure::read('sendEmail')) {
            // Wrap sending email in try/catch
            $email = new Email('default');
            $email->template('verify')
                    ->emailFormat('html')
                    ->viewVars([
                        'emailAddr' => $user->email,
                        'verifyHash' => $jobfunc->func_data,
                    ]);
            $email->from(['jblackx-findmypet@yahoo.com' => 'FindMyPet.com'])
                    ->to('jeff.black@outlook.com')
                    ->subject('About')
                    ->send('Confirm Registration');
        }
    }
}
