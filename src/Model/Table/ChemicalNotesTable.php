<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChemicalNotes Model
 *
 * @property \App\Model\Table\ChemicalsTable&\Cake\ORM\Association\HasMany $Chemicals
 *
 * @method \App\Model\Entity\ChemicalNote newEmptyEntity()
 * @method \App\Model\Entity\ChemicalNote newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChemicalNote findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ChemicalNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalNote[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChemicalNote|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChemicalNote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChemicalNote[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ChemicalNote[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ChemicalNote[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ChemicalNote[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ChemicalNotesTable extends Table
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

        $this->setTable('chemical_notes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Chemicals', [
            'foreignKey' => 'chemical_note_id',
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
            ->notEmptyString('name');

        $validator
            ->scalar('class')
            ->maxLength('class', 45)
            ->allowEmptyString('class');

        return $validator;
    }
}
