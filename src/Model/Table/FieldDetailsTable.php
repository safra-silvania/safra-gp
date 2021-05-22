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
 * FieldDetails Model
 *
 * @property \App\Model\Table\FieldsTable&\Cake\ORM\Association\BelongsTo $Fields
 * @property \App\Model\Table\CulturesTable&\Cake\ORM\Association\BelongsTo $Cultures
 * @property \App\Model\Table\FertilitiesTable&\Cake\ORM\Association\BelongsTo $Fertilities
 * @property \App\Model\Table\MeasureUnitsTable&\Cake\ORM\Association\BelongsTo $MeasureUnits
 * @property \App\Model\Table\PlanFieldDetailsTable&\Cake\ORM\Association\HasMany $PlanFieldDetails
 *
 * @method \App\Model\Entity\FieldDetail newEmptyEntity()
 * @method \App\Model\Entity\FieldDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FieldDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FieldDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\FieldDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FieldDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FieldDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FieldDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FieldDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FieldDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FieldDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FieldDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FieldDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FieldDetailsTable extends Table
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

        $this->setTable('field_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fields', [
            'foreignKey' => 'field_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cultures', [
            'foreignKey' => 'culture_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fertilities', [
            'foreignKey' => 'fertility_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MeasureUnits', [
            'foreignKey' => 'measure_unit_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PlanFieldDetails', [
            'foreignKey' => 'field_detail_id',
        ]);

        $this->addBehavior('AuditStash.AuditLog', [
            'blacklist' => ['id', 'created', 'modified']
        ]);
    }

    public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        if (isset($entity->area) && !empty($entity->area)) {
            $entity->set('area', str_replace(',', '.', str_replace('.', '', $entity->area)));
        }
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
            ->decimal('area')
            ->requirePresence('area', 'create')
            ->notEmptyString('area');

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
        $rules->add($rules->existsIn(['field_id'], 'Fields'));
        $rules->add($rules->existsIn(['culture_id'], 'Cultures'));
        $rules->add($rules->existsIn(['fertility_id'], 'Fertilities'));
        $rules->add($rules->existsIn(['measure_unit_id'], 'MeasureUnits'));

        return $rules;
    }

    public function getTotalAreaGroupByCulture($fieldId): Query
    {
        $query = $this->find()
            ->join([
                'f' => [
                    'table' => 'fields',
                    'type' => 'INNER',
                    'conditions' => 'f.id = FieldDetails.field_id',
                ],
                'c' => [
                    'table' => 'cultures',
                    'type' => 'INNER',
                    'conditions' => 'c.id = FieldDetails.culture_id',
                ]
            ]);
        
        $totals = $query->select([
            'culture' => 'c.name',
            'sum' => $query->func()->sum('area')
        ])
        ->where(['field_id' => $fieldId])
        ->group(['field_id', 'c.id']);

        return $totals;
    }
}
