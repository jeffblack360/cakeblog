<?php
namespace App\Model\Table;

use ArrayObject;

use App\Model\Entity\User;
use Cake\Log\Log;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
        
/**
 * Users Model
 *
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
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
            ->notEmpty('username', 'A username is required.')
            ->add('username',[
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'The username is already taken.'
                ]
            ]);

        $validator
            ->notEmpty('password', 'A password is required.');

        $validator
            ->requirePresence('role', false)
            ->allowEmpty('role');

        $validator
            ->requirePresence('email', 'create', 'An email is required.')
            ->notEmpty('email', 'An email is required.')
            ->add('email', [
                'validEmail' => [
                    'rule' => ['email'],
                    'message' => 'Please provide a valid email.'
                ],
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'The email is already taken.'
                ]
            ]);
        
        $validator
                ->requirePresence('cemail', 'create', 'An email is required.')
                ->notEmpty('cemail', 'Confirm email is required.')
                ->add('cemail', 'custom', [
                    'rule' => function($value, $context) {
                        if (isset($context['data']['email']) &&
                                $value == $context['data']['email']) {
                            return true;
                        }
                        return false;
                    },
                    'message' => 'email and confirm email do not match.'
        ]);

        $validator
                ->requirePresence('cpassword', 'create', 'A password is required.')
                ->notEmpty('cpassword', 'Confirm password is required.')
                ->add('cpassword', 'custom', [
                    'rule' => function($value, $context) {
                        if (isset($context['data']['password']) &&
                                $value == $context['data']['password']) {
                            return true;
                        }
                        return false;
                    },
                    'message' => 'password and confirm password do not match.'
        ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        return $rules;
    }

    /**
     * Perform activity after a User has been saved
     *
     * @param \Cake\Event\Event $event The event instance
     * @param \Cake\ORM\Entity $entity The user entity saved
     * @param ArrayObject $options Misc options if any
     * @return void
     */
    public function afterSave(Event $event, User $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            Log::write('info', 'User created: '. $entity->id);
            // For a new user write registration verification rec to job_funcs
            $jobFuncsTable = TableRegistry::get('JobFuncs');
            $jobFuncsTable->createVerifyEmailJob($entity);
        } else {
            Log::write('info', 'User saved: '. $entity->id);
        }
        
//        $this->dispatchEvent('UsersTable.afterSave', compact('entity','options'));        
    }

    /**
     * Perform activity after a User has been saved and commited
     *
     * @param \Cake\Event\Event $event The event instance
     * @param \Cake\ORM\Entity $entity The user entity saved
     * @param ArrayObject $options Misc options if any
     * @return void
     */
    public function afterSaveCommit(Event $event, User $entity, ArrayObject $options)
    {
//        Log::write('info', 'in UsersTable.afterSaveCommit '. $entity->username);        
    }
    
   /**
    * verifyUser method
    * 
    * Confirm user registration
    *
    * @return boolean true/false
    */
    public function verifyUser($hash) {
        Log::write('info', 'Begin verifyUser hash = '. $hash);
        
        $jobFuncsTable = TableRegistry::get('JobFuncs');
        
        $jobfuncs = $jobFuncsTable->find()
                ->where([
                    'process_name' => 'email',
                    'process_status' => 'cmpl',
                    'func_name' => 'verify',
                    'func_status' => 'sent',
                    'func_data' => $hash,
                ]);
        
        $jobfunc = $jobfuncs->first();
        if (empty($jobfunc)) {
            return false;
        }
        
        $user = $this->find()
                    ->where([
                        'id' => $jobfunc->func_opt,
                    ])->first();
        if (empty($user)) {
            return false;
        }

        if (md5($user->username) != $hash) {
            return false;
        }
        
        $jobfunc->func_status = 'cmpl';
        $jobFuncsTable->save($jobfunc);

        $user->status = 'enabled';
        $this->save($user);
        
        Log::write('info', 'End verifyUser hash = '. $hash);
        return true;
    }            
}
