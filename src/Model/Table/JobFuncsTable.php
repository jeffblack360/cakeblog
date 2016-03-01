<?php
namespace App\Model\Table;

use App\Model\Entity\JobFunc;
use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Log\LogTrait;
use Carbon\Carbon;

/**
 * JobFuncs Model
 *
 */
class JobFuncsTable extends Table
{
    use LogTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('job_funcs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('process_name', 'create')
            ->notEmpty('process_name');

        $validator
            ->requirePresence('process_status', 'create')
            ->notEmpty('process_status');

        $validator
            ->allowEmpty('process_opt');

        $validator
            ->requirePresence('func_name', 'create')
            ->notEmpty('func_name');

        $validator
            ->allowEmpty('func_status');

        $validator
            ->allowEmpty('func_opt');

        $validator
            ->allowEmpty('func_data');

        return $validator;
    }

    /**
     * getVerifyEmailJobs method
     *
     * @param null
     * @return Cake\ORM\Query;
     */
    public function getVerifyEmailJobs()
    {
        $jobfuncs = $this->find()
                ->where([
                    'process_name' => 'email',
                    'process_status' => 'new',
                    'func_name' => 'verify',
                ])
                ->order(['created' => 'ASC']);
        return $jobfuncs;
    }
    
    /**
     * expireVerifyEmail method
     *
     * @param null
     * @return void
     */
    public function expireVerifyEmail()
    {
        $this->log('Start expireVerifyEmail', 'info');
        $jobfuncs = $this->find()
                ->where([
                    'process_name' => 'email',
                    'process_status' => 'new',
                    'func_name' => 'verify',
                    'created <=' => Carbon::now(-6)->subHours(48)
                ])
                ->order(['created' => 'ASC']);
        
        foreach ($jobfuncs as $jobfunc) {
            $this->log('expire job_func: ' . $jobfunc->id, 'info');
            $jobfunc->process_status = 'cmpl';
            $jobfunc->func_status = 'expired';
            $this->save($jobfunc);
        }
        $this->log('End expireVerifyEmail', 'info');
    }
    
   /**
    * updateVerifyJobSent() method
    * 
    * Update job_funcs verify record associated with a user
    *
    * @return void
    */
    public function updateVerifyJobSent(JobFunc $jobfunc) {
        $jobfunc->process_status = 'cmpl';
        $jobfunc->func_status = 'sent';
        $this->save($jobfunc);
    }

   /**
    * userVerified() method
    * 
    * Update job_funcs that user is verified
    *
    * @return void
    */
//    public function userVerified($hash) {
//        $this->log('Start userVerified', 'info');
//        
//        $jobfuncs = $this->find()
//                ->where([
//                    'process_name' => 'email',
//                    'process_status' => 'cmpl',
//                    'func_name' => 'verify',
//                    'func_status' => 'sent',
//                ])
//                ->first();
//        
////        $jobfunc->process_status = 'cmpl';
////        $jobfunc->func_status = 'sent';
////        $this->save($jobfunc);
//    }        
    
    
   /**
    * createVerifyEmailJob method
    * 
    * Create send verify email job record
    *
    * @return void
    */
    public function createVerifyEmailJob(User $user) {
        $this->log('Begin createVerifyEmailJob', 'info');
        $jobfunc = $this->newEntity();
        $jobfunc->process_name = 'email';
        $jobfunc->process_status = 'new';
        $jobfunc->func_status = null;
        $jobfunc->func_opt = $user->id;
        $jobfunc->func_data = md5($user->username);
        $this->log($jobfunc, 'info');
        $this->save($jobfunc);
        $this->log('End createVerifyEmailJob', 'info');
    }        
}
