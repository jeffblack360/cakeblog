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

    public function afterSave(Event $event, User $entity, ArrayObject $options)
    {
        Log::write('info', 'in UsersTable.afterSave '. $entity->username);
        $this->dispatchEvent('UsersTable.afterSave', compact('entity','options'));
    }
}
