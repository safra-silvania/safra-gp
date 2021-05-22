<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SelectedFertilizers Model
 *
 * @property \App\Model\Table\FertilizersTable&\Cake\ORM\Association\BelongsTo $Fertilizers
 * @property \App\Model\Table\PlansTable&\Cake\ORM\Association\BelongsTo $Plans
 *
 * @method \App\Model\Entity\SelectedFertilizer newEmptyEntity()
 * @method \App\Model\Entity\SelectedFertilizer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SelectedFertilizer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SelectedFertilizer get($primaryKey, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SelectedFertilizer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SelectedFertilizer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SelectedFertilizer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SelectedFertilizersTable extends Table
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

        $this->setTable('selected_fertilizers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fertilizers', [
            'foreignKey' => 'fertilizer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['fertilizer_id'], 'Fertilizers'));
        $rules->add($rules->existsIn(['plan_id'], 'Plans'));

        return $rules;
    }
}
