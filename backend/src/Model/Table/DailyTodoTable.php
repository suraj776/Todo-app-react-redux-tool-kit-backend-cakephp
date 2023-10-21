<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DailyTodo Model
 *
 * @property \App\Model\Table\UserTable&\Cake\ORM\Association\BelongsTo $User
 *
 * @method \App\Model\Entity\DailyTodo newEmptyEntity()
 * @method \App\Model\Entity\DailyTodo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DailyTodo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DailyTodo get($primaryKey, $options = [])
 * @method \App\Model\Entity\DailyTodo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DailyTodo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DailyTodo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DailyTodo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DailyTodo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DailyTodo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DailyTodo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DailyTodo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DailyTodo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DailyTodoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('daily_todo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('day')
            ->maxLength('day', 15)
            ->requirePresence('day', 'create')
            ->notEmptyString('day');

        $validator
            ->scalar('story')
            ->requirePresence('story', 'create')
            ->notEmptyString('story');

        $validator
            ->boolean('saved')
            ->allowEmptyString('saved');
        $validator
            ->boolean('completed')
            ->allowEmptyString('completed');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmptyDateTime('created_on');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'User'), ['errorField' => 'user_id']);

        return $rules;
    }
}
