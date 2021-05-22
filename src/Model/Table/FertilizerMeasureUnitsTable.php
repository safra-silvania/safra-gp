<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FertilizerMeasureUnits Model
 *
 * @property \App\Model\Table\FertilizersTable&\Cake\ORM\Association\HasMany $Fertilizers
 *
 * @method \App\Model\Entity\FertilizerMeasureUnit newEmptyEntity()
 * @method \App\Model\Entity\FertilizerMeasureUnit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit get($primaryKey, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FertilizerMeasureUnit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FertilizerMeasureUnitsTable extends Table
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

        $this->setTable('fertilizer_measure_units');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fertilizers', [
            'foreignKey' => 'fertilizer_measure_unit_id',
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
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('initial')
            ->maxLength('initial', 45)
            ->requirePresence('initial', 'create')
            ->notEmptyString('initial')
            ->add('initial', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['initial']));

        return $rules;
    }
}
