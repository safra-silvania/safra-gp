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
 * Seeds Model
 *
 * @property \App\Model\Table\SeedNotesTable&\Cake\ORM\Association\BelongsTo $SeedNotes
 * @property \App\Model\Table\CulturesTable&\Cake\ORM\Association\BelongsTo $Cultures
 * @property \App\Model\Table\VarietiesTable&\Cake\ORM\Association\BelongsTo $Varieties
 * @property \App\Model\Table\TechnologiesTable&\Cake\ORM\Association\BelongsTo $Technologies
 * @property \App\Model\Table\CyclesTable&\Cake\ORM\Association\BelongsTo $Cycles
 * @property \App\Model\Table\ZoningRegionsTable&\Cake\ORM\Association\BelongsTo $ZoningRegions
 * @property \App\Model\Table\ProductivePotencialsTable&\Cake\ORM\Association\BelongsTo $ProductivePotencials
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\FertilitiesTable&\Cake\ORM\Association\BelongsToMany $Fertilities
 *
 * @method \App\Model\Entity\Seed newEmptyEntity()
 * @method \App\Model\Entity\Seed newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Seed[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Seed get($primaryKey, $options = [])
 * @method \App\Model\Entity\Seed findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Seed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Seed[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Seed|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Seed saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Seed[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Seed[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Seed[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Seed[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SeedsTable extends Table
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

        $this->setTable('seeds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SeedNotes', [
            'foreignKey' => 'seed_note_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cultures', [
            'foreignKey' => 'culture_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Varieties', [
            'foreignKey' => 'variety_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Technologies', [
            'foreignKey' => 'technology_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cycles', [
            'foreignKey' => 'cycle_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ZoningRegions', [
            'foreignKey' => 'zoning_region_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductivePotencials', [
            'foreignKey' => 'productive_potencial_id',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
        ]);
        $this->belongsToMany('Fertilities', [
            'foreignKey' => 'seed_id',
            'targetForeignKey' => 'fertility_id',
            'joinTable' => 'fertilities_seeds',
        ]);

        $this->hasMany('SelectedSeeds', [
            'foreignKey' => 'seed_id',
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
            ->decimal('maturation_group')
            ->requirePresence('maturation_group', 'create')
            ->notEmptyString('maturation_group');

        $validator
            ->integer('cycle_days')
            ->requirePresence('cycle_days', 'create')
            ->notEmptyString('cycle_days');

        $validator
            ->scalar('cycle_id')
            ->greaterThan('cycle_id', 0, 'O Ciclo informado não pertence aos intervalos definidos no cadastro de Ciclos');

        $validator
            ->scalar('resistency')
            ->maxLength('resistency', 45)
            ->allowEmptyString('resistency');

        $validator
            ->scalar('population')
            ->maxLength('population', 45)
            ->allowEmptyString('population');

        $validator
            ->scalar('observations')
            ->allowEmptyString('observations');

        return $validator;
    }

    public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        if (isset($entity->maturation_group) && !empty($entity->maturation_group)) {
            $entity->set('maturation_group', str_replace(',', '.', str_replace('.', '', $entity->maturation_group)));
        }
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
        $rules->add($rules->existsIn(['seed_note_id'], 'SeedNotes'));
        $rules->add($rules->existsIn(['culture_id'], 'Cultures'));
        $rules->add($rules->existsIn(['variety_id'], 'Varieties'));
        $rules->add($rules->existsIn(['technology_id'], 'Technologies'));
        $rules->add($rules->existsIn(['cycle_id'], 'Cycles'));
        $rules->add($rules->existsIn(['zoning_region_id'], 'ZoningRegions'));
        $rules->add($rules->existsIn(['productive_potencial_id'], 'ProductivePotencials'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));

        return $rules;
    }

    public function getLastestUpdate()
    {
        $query = $this->find();
        
        $maxDate = $query->select(['max' => $query->func()->max('modified')]);

        return $maxDate->first()->max;
    }
    
}
