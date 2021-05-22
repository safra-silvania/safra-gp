<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cycles Model
 *
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\HasMany $Seeds
 *
 * @method \App\Model\Entity\Cycle newEmptyEntity()
 * @method \App\Model\Entity\Cycle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cycle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cycle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cycle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cycle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cycle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cycle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cycle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cycle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cycle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cycle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cycle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CyclesTable extends Table
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

        $this->setTable('cycles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Seeds', [
            'foreignKey' => 'cycle_id',
        ]);

        $this->addBehavior('AuditStash.AuditLog', [
            'blacklist' => ['id', 'created', 'modified']
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        // $validator
        //     ->integer('start')
        //     ->requirePresence('start', 'create')
        //     ->notEmptyString('start');

        // $validator
        //     ->integer('end')
        //     ->requirePresence('end', 'create')
        //     ->notEmptyString('end');

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
        $rules->add($rules->isUnique(['name']));

        $rules->addDelete(function ($entity, $options) {
            $seeds = $this->Seeds->find()->where(['cycle_id' => $entity->id])->count();
            return $seeds == 0;
        }, 'hasSeeds', ['errorField' => 'seeds', 'message' => 'Este Ciclo possui Sementes vinculadas']);

        return $rules;
    }
}
