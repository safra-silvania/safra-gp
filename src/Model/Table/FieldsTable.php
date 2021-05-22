<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * Fields Model
 *
 * @property \App\Model\Table\ImmobilesTable&\Cake\ORM\Association\BelongsTo $Immobiles
 * @property \App\Model\Table\MeasureUnitsTable&\Cake\ORM\Association\BelongsTo $MeasureUnits
 * @property \App\Model\Table\CultivationSystemsTable&\Cake\ORM\Association\BelongsTo $CultivationSystems
 * @property \App\Model\Table\FertilitiesTable&\Cake\ORM\Association\BelongsTo $Fertilities
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\FieldDetailsTable&\Cake\ORM\Association\HasMany $FieldDetails
 * @property \App\Model\Table\SketchesTable&\Cake\ORM\Association\HasMany $Sketches
 *
 * @method \App\Model\Entity\Field newEmptyEntity()
 * @method \App\Model\Entity\Field newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Field[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Field get($primaryKey, $options = [])
 * @method \App\Model\Entity\Field findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Field patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Field[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Field|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Field saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Field[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Field[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Field[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Field[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FieldsTable extends Table
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

        $this->setTable('fields');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Immobiles', [
            'foreignKey' => 'immobile_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MeasureUnits', [
            'foreignKey' => 'measure_unit_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CultivationSystems', [
            'foreignKey' => 'cultivation_system_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fertilities', [
            'foreignKey' => 'fertility_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('FieldDetails', [
            'foreignKey' => 'field_id',
        ]);
        $this->hasMany('Sketches', [
            'foreignKey' => 'field_id',
        ]);

        $this->addBehavior('AuditStash.AuditLog', [
            'blacklist' => ['id', 'created', 'modified']
        ]);
    }

    public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        if (isset($entity->total_area) && !empty($entity->total_area)) {
            $entity->set('total_area', str_replace(',', '.', str_replace('.', '', $entity->total_area)));
        }
    }

    public function afterSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        $this->insertPlanFieldAfterPlanning($entity);
    }

    public function insertPlanFieldAfterPlanning(Entity $entity)
    {
        // $plan = $this->Immobiles->Plans->find()->where(['Plans.immobile_id' => $entity->immobile_id])->first();
        // if ($plan) {
        //     $plansFields = $this->Immobiles->Plans->PlanFields;

        //     $planField = $plansFields->newEmptyEntity();
        //     $planField = $plansFields->patchEntity($planField, [
        //         'field_id' => $entity->id,
        //         'plan_id' => $plan->id,
        //         // 'sequence' => 
        //     ]);
        //     $plansFields->save($planField);
        // }
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
            ->notEmptyString('name');

        $validator
            ->decimal('total_area')
            ->requirePresence('total_area', 'create')
            ->notEmptyString('total_area');

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
        $rules->add($rules->existsIn(['immobile_id'], 'Immobiles'));
        $rules->add($rules->existsIn(['measure_unit_id'], 'MeasureUnits'));
        $rules->add($rules->existsIn(['cultivation_system_id'], 'CultivationSystems'));
        $rules->add($rules->existsIn(['fertility_id'], 'Fertilities'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        $rules->addDelete(function ($entity, $options) {
            return $this->FieldDetails->find()->where(['field_id' => $entity->id])->count() == 0;
        }, 'hasFieldDetails', ['errorField' => 'fieldDetails', 'message' => 'Este Talhão possui Culturas vinculadas']);
        return $rules;
    }

    public function getFieldsByImmobile($immobileId): Query
    {
        $fields = $this->find()
            ->where(['immobile_id' => $immobileId])
            ->contain(['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities', 'FieldDetails.Cultures', 'FieldDetails.MeasureUnits', 'FieldDetails.Fertilities'])
            ->order(['Fields.id' => 'ASC']);

        return $fields;
    }
}
