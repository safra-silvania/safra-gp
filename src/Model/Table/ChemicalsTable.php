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
 * Chemicals Model
 *
 * @property \App\Model\Table\ChemicalNotesTable&\Cake\ORM\Association\BelongsTo $ChemicalNotes
 * @property \App\Model\Table\ChemicalClassesTable&\Cake\ORM\Association\BelongsTo $ChemicalClasses
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\ChemicalMeasureUnitsTable&\Cake\ORM\Association\BelongsTo $ChemicalMeasureUnits
 * @property \App\Model\Table\ChemicalTargetsTable&\Cake\ORM\Association\BelongsTo $ChemicalTargets
 * @property \App\Model\Table\ApplicationSeasonsTable&\Cake\ORM\Association\BelongsToMany $ApplicationSeasons
 * @property \App\Model\Table\ChemicalActionModesTable&\Cake\ORM\Association\BelongsToMany $ChemicalActionModes
 * @property \App\Model\Table\CulturesTable&\Cake\ORM\Association\BelongsToMany $Cultures
 *
 * @method \App\Model\Entity\Chemical newEmptyEntity()
 * @method \App\Model\Entity\Chemical newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Chemical[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Chemical get($primaryKey, $options = [])
 * @method \App\Model\Entity\Chemical findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Chemical patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Chemical[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Chemical|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Chemical saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Chemical[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Chemical[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Chemical[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Chemical[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChemicalsTable extends Table
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

        $this->setTable('chemicals');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ChemicalNotes', [
            'foreignKey' => 'chemical_note_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ChemicalClasses', [
            'foreignKey' => 'chemical_class_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ChemicalMeasureUnits', [
            'foreignKey' => 'chemical_measure_unit_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ChemicalTargets', [
            'foreignKey' => 'chemical_target_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('ApplicationSeasons', [
            'foreignKey' => 'chemical_id',
            'targetForeignKey' => 'application_season_id',
            'joinTable' => 'chemicals_application_seasons',
        ]);
        $this->belongsToMany('ChemicalActionModes', [
            'foreignKey' => 'chemical_id',
            'targetForeignKey' => 'chemical_action_mode_id',
            'joinTable' => 'chemicals_chemical_action_modes',
        ]);
        $this->belongsToMany('ChemicalGroups', [
            'foreignKey' => 'chemical_id',
            'targetForeignKey' => 'chemical_group_id',
            'joinTable' => 'chemicals_chemical_groups',
        ]);
        $this->belongsToMany('Cultures', [
            'foreignKey' => 'chemical_id',
            'targetForeignKey' => 'culture_id',
            'joinTable' => 'chemicals_cultures',
        ]);

        $this->hasMany('SelectedChemicals', [
            'foreignKey' => 'chemical_id',
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
            ->decimal('dose')
            ->requirePresence('dose', 'create')
            ->notEmptyString('dose');

        $validator
            ->scalar('incompatibility')
            ->allowEmptyString('incompatibility');

        $validator
            ->scalar('observation')
            ->allowEmptyString('observation');

        return $validator;
    }

    public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        if (isset($entity->dose) && !empty($entity->dose)) {
            $entity->set('dose', str_replace(',', '.', str_replace('.', '', $entity->dose)));
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
        $rules->add($rules->isUnique(['name']));
        $rules->add($rules->existsIn(['chemical_note_id'], 'ChemicalNotes'));
        $rules->add($rules->existsIn(['chemical_class_id'], 'ChemicalClasses'));
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));
        $rules->add($rules->existsIn(['chemical_measure_unit_id'], 'ChemicalMeasureUnits'));
        $rules->add($rules->existsIn(['chemical_target_id'], 'ChemicalTargets'));
        $rules->add($rules->existsIn(['chemical_group_id'], 'ChemicalGroups'));

        return $rules;
    }
}
