<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChemicalMeasureUnits Model
 *
 * @property \App\Model\Table\ChemicalsTable&\Cake\ORM\Association\HasMany $Chemicals
 *
 * @method \App\Model\Entity\ChemicalMeasureUnit newEmptyEntity()
 * @method \App\Model\Entity\ChemicalMeasureUnit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ChemicalMeasureUnit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChemicalMeasureUnitsTable extends Table
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

        $this->setTable('chemical_measure_units');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Chemicals', [
            'foreignKey' => 'chemical_measure_unit_id',
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
