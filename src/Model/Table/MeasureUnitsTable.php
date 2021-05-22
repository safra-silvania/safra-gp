<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MeasureUnits Model
 *
 * @property \App\Model\Table\FieldsTable&\Cake\ORM\Association\HasMany $Fields
 *
 * @method \App\Model\Entity\MeasureUnit newEmptyEntity()
 * @method \App\Model\Entity\MeasureUnit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MeasureUnit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MeasureUnit get($primaryKey, $options = [])
 * @method \App\Model\Entity\MeasureUnit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MeasureUnit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MeasureUnit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MeasureUnit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MeasureUnit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MeasureUnit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MeasureUnit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MeasureUnit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MeasureUnit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MeasureUnitsTable extends Table
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

        $this->setTable('measure_units');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fields', [
            'foreignKey' => 'measure_unit_id',
        ]);

        $this->hasMany('FieldDetails', [
            'foreignKey' => 'measure_unit_id',
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

        $rules->addDelete(function ($entity, $options) {
            $fields = $this->Fields->find()->where(['measure_unit_id' => $entity->id])->count();
            return $fields == 0;
        }, 'hasFields', ['errorField' => 'fields', 'message' => 'Esta Unidade de Medida possui Talhões vinculados']);

        $rules->addDelete(function ($entity, $options) {
            $fieldDetails = $this->FieldDetails->find()->where(['measure_unit_id' => $entity->id])->count();
            return $fieldDetails == 0;
        }, 'hasFieldDetails', ['errorField' => 'fieldDetails', 'message' => 'Esta Unidade de Medida possui Culturas de Talhão vinculadas']);

        return $rules;
    }
}
