<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plans Model
 *
 * @property \App\Model\Table\ImmobilesTable&\Cake\ORM\Association\BelongsTo $Immobiles
 * @property \App\Model\Table\PlanStatusesTable&\Cake\ORM\Association\BelongsTo $PlanStatuses
 * @property \App\Model\Table\PlanFieldDetailsTable&\Cake\ORM\Association\HasMany $PlanFieldDetails
 * @property \App\Model\Table\SelectedChemicalsTable&\Cake\ORM\Association\HasMany $SelectedChemicals
 * @property \App\Model\Table\SelectedFertilizersTable&\Cake\ORM\Association\HasMany $SelectedFertilizers
 * @property \App\Model\Table\SelectedSeedsTable&\Cake\ORM\Association\HasMany $SelectedSeeds
 *
 * @method \App\Model\Entity\Plan newEmptyEntity()
 * @method \App\Model\Entity\Plan newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Plan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plan get($primaryKey, $options = [])
 * @method \App\Model\Entity\Plan findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Plan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Plan[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlansTable extends Table
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

        $this->setTable('plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Immobiles', [
            'foreignKey' => 'immobile_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlanStatuses', [
            'foreignKey' => 'plan_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PlanFieldDetails', [
            'foreignKey' => 'plan_id',
        ]);
        $this->hasMany('SelectedChemicals', [
            'foreignKey' => 'plan_id',
        ]);
        $this->hasMany('SelectedFertilizers', [
            'foreignKey' => 'plan_id',
        ]);
        $this->hasMany('SelectedSeeds', [
            'foreignKey' => 'plan_id',
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
        $rules->add($rules->existsIn(['immobile_id'], 'Immobiles'));
        $rules->add($rules->existsIn(['plan_status_id'], 'PlanStatuses'));

        return $rules;
    }

    public function startPlanning($immobileId)
    {
        if (!$this->Immobiles->isCompletedArea($immobileId)) {
            throw new \Exception("A área total de algum talhão não está completa!");
        }

        $plan = $this->newEmptyEntity();

        $newPlan = $this->patchEntity($plan, ['immobile_id' => $immobileId]);

        $this->save($newPlan);

        $fields = $this->Immobiles->Fields->find('all')
            ->where(['immobile_id' => $immobileId])
            ->order(['Fields.id' => 'ASC']);

        $i = 1;
        foreach ($fields as $field) {

            $fieldDetails = $this->Immobiles->Fields->FieldDetails->find('all')
                ->where(['FieldDetails.field_id' => $field->id])
                ->order(['FieldDetails.id' => 'ASC']);

            foreach ($fieldDetails as $fieldDetail) {
                $planField = $this->PlanFieldDetails->newEmptyEntity();
                $planField = $this->PlanFieldDetails->patchEntity($planField, [
                    'field_detail_id' => $fieldDetail->id,
                    'plan_id' => $newPlan->id,
                    'sequence' => $i++
                ]);
    
                $this->PlanFieldDetails->save($planField);
            }
        }

        return $newPlan;
    }
}
