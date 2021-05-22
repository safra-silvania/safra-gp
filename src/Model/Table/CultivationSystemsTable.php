<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CultivationSystems Model
 *
 * @property \App\Model\Table\FieldsTable&\Cake\ORM\Association\HasMany $Fields
 *
 * @method \App\Model\Entity\CultivationSystem newEmptyEntity()
 * @method \App\Model\Entity\CultivationSystem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CultivationSystem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CultivationSystem get($primaryKey, $options = [])
 * @method \App\Model\Entity\CultivationSystem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CultivationSystem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CultivationSystem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CultivationSystem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CultivationSystem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CultivationSystem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CultivationSystem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CultivationSystem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CultivationSystem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CultivationSystemsTable extends Table
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

        $this->setTable('cultivation_systems');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fields', [
            'foreignKey' => 'cultivation_system_id',
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
            $fields = $this->Fields->find()->where(['cultivation_system_id' => $entity->id])->count();
            return $fields == 0;
        }, 'hasFields', ['errorField' => 'fields', 'message' => 'Este Sistema de Cultivo possui Talhões vinculados']);

        return $rules;
    }
}
