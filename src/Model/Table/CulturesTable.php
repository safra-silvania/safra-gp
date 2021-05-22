<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cultures Model
 *
 * @property \App\Model\Table\FieldDetailsTable&\Cake\ORM\Association\HasMany $FieldDetails
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\HasMany $Seeds
 *
 * @method \App\Model\Entity\Culture newEmptyEntity()
 * @method \App\Model\Entity\Culture newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Culture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Culture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Culture findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Culture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Culture[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Culture|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Culture saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Culture[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Culture[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Culture[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Culture[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CulturesTable extends Table
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

        $this->setTable('cultures');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('FieldDetails', [
            'foreignKey' => 'culture_id',
        ]);
        $this->hasMany('Seeds', [
            'foreignKey' => 'culture_id',
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
            $fieldDetails = $this->FieldDetails->find()->where(['culture_id' => $entity->id])->count();
            return $fieldDetails == 0;
        }, 'hasFieldDetails', ['errorField' => 'fieldDetails', 'message' => 'Esta Cultura possui Talhões vinculados']);
        
        $rules->addDelete(function ($entity, $options) {
            $seeds = $this->Seeds->find()->where(['culture_id' => $entity->id])->count();
            return $seeds == 0;
        }, 'hasSeeds', ['errorField' => 'seeds', 'message' => 'Esta Cultura possui Sementes vinculadas']);

        return $rules;
    }
}
