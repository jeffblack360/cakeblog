<?php
namespace App\Shell;

use Cake\Core\Configure;
use Cake\Console\Shell;
use Cake\Network\Email\Email;
use Cake\Utility\Security;
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

        $jobfuncs = $this->JobFuncs->verifyEmailJobs();
        
        // Send verify registration email for each record
        foreach ($jobfuncs as $jobfunc) {
            $query = $this->Users->find()
                    ->where(['id' => $jobfunc->func_opt]);
            $user = $query->first();
            $jobfunc->func_data = md5($user->username);
            $this->_sendEmail($jobfunc, $user);
            $this->JobFuncs->updateVerifyJobSent($jobfunc);
        }
        
        $this->log('End _sendVerifyEmail', 'info');
        
        return;
    }
    
   /**
    * _sendEmail() method
    * 
    * Reusable function to send emails to a user.
    * 
    * Example: https://cakeblog.local/verify/pfOvslMj2LK3vvPi8ONLMA99sYRMynyr
    *
    * @return void
    */
    private function _sendEmail(JobFunc $jobfunc, User $user) {
        $this->log(
                'Send verify email to ' .
                'id: ' . $user->id . ' ' .
                'username: ' . $user->username . ' ' .
                'email: ' . $user->email . ' ' .
                'func_data: ' . $jobfunc->func_data
                , 'info'
        );
        
        // Wrap sending email in try/catch
        // if success sending email then update job_funcs record
        
//        $email = new Email('default');
//        $email->template('verify')
//                ->emailFormat('html')
//                ->viewVars([
//                    'emailAddr' => $user->email,
//                    'verifyHash' => $jobfunc->func_data,
//                ]);
//        $email->from(['jblackx-findmypet@yahoo.com' => 'FindMyPet.com'])
//                ->to('jeff.black@outlook.com')
//                ->subject('About')
//                ->send('Confirm Registration');
    }
}
