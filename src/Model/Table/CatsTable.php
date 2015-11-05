<?php
namespace App\Model\Table;

use App\Model\Entity\Cat;
use Cake\Log\Log;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cats Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Breeds
 */
class CatsTable extends Table
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

        $this->table('cats');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Breeds', [
            'foreignKey' => 'breed_id',
            'joinType' => 'INNER'
        ]);
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        Log::write("debug","buildRules");
        $rules->add($rules->existsIn(['breed_id'], 'Breeds'));
        return $rules;
    }
    
    public function beforeRules(Event $event, Cat $entity, $options, $operation)
    {
        Log::write("debug", "beforeRules");
        Log::write("debug", $options);
    }
    
    public function afterRules(Cake\Event\Event $event, Cat $entity, \ArrayObject $options, $result, $operation)
    {
        Log::write("debug", "afterRules");
        Log::write("debug", $event->name());
        Log::write("debug", "entity " . $entity);
        Log::write("debug", $options);
        Log::write("debug", "result " . $result);
        Log::write("debug", "operation " . $operation);
    }
}