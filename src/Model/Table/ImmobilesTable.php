<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Immobiles Model
 *
 * @property \App\Model\Table\ProducersTable&\Cake\ORM\Association\BelongsTo $Producers
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\FieldsTable&\Cake\ORM\Association\HasMany $Fields
 * @property \App\Model\Table\PlansTable&\Cake\ORM\Association\HasMany $Plans
 *
 * @method \App\Model\Entity\Immobile newEmptyEntity()
 * @method \App\Model\Entity\Immobile newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Immobile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Immobile get($primaryKey, $options = [])
 * @method \App\Model\Entity\Immobile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Immobile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Immobile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Immobile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Immobile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Immobile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Immobile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Immobile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Immobile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ImmobilesTable extends Table
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

        $this->setTable('immobiles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Producers', [
            'foreignKey' => 'producer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Fields', [
            'foreignKey' => 'immobile_id',
        ]);
        $this->hasMany('Plans', [
            'foreignKey' => 'immobile_id',
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
            ->scalar('harvest')
            ->maxLength('harvest', 45)
            ->requirePresence('harvest', 'create')
            ->notEmptyString('harvest');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('observations')
            ->allowEmptyString('observations');

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
        $rules->add($rules->existsIn(['producer_id'], 'Producers'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        $rules->addDelete(function ($entity, $options) {
            $fields = $this->Fields->find()->where(['immobile_id' => $entity->id])->count();
            return $fields == 0;
        }, 'hasFields', ['errorField' => 'fields', 'message' => 'Este Imóvel possui Talhões vinculados']);

        $rules->addDelete(function ($entity, $options) {
            return $this->Plans->find()->where(['immobile_id' => $entity->id])->count() == 0;
        }, 'hasPlans', ['errorField' => 'plans', 'message' => 'Este Imóvel possui Planejamento vinculado']);

        return $rules;
    }

    public function getTotalAreaGroupByCultivationSystem($immobileId): Query
    {
        $query = $this->find()
            ->join([
                'f' => [
                    'table' => 'fields',
                    'type' => 'INNER',
                    'conditions' => 'f.immobile_id = Immobiles.id',
                ],
                'cs' => [
                    'table' => 'cultivation_systems',
                    'type' => 'INNER',
                    'conditions' => 'cs.id = f.cultivation_system_id',
                ]
            ]);
        
        $totals = $query->select([
            'cultivation_system' => 'cs.name',
            'sum' => $query->func()->sum('f.total_area')
        ])
        ->where(['immobile_id' => $immobileId])
        ->group(['immobile_id', 'cultivation_system_id']);

        return $totals;
    }

    public function isCompletedArea($immobileId): bool
    {
        $fields = $this->Fields->findByImmobileId($immobileId)->contain(['FieldDetails']);
        if ($fields->count() == 0) return false;

        foreach ($fields as $field) {
            $sum = 0;
            foreach ($field->field_details as $detail)
                $sum += $detail->area;
            
            if ($field->total_area != $sum)
                return false;
        }
        return true;
    }
    
}
