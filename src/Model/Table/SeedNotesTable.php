<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeedNotes Model
 *
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\HasMany $Seeds
 *
 * @method \App\Model\Entity\SeedNote newEmptyEntity()
 * @method \App\Model\Entity\SeedNote newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SeedNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SeedNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\SeedNote findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SeedNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SeedNote[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SeedNote|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeedNote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeedNote[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SeedNote[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SeedNote[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SeedNote[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SeedNotesTable extends Table
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

        $this->setTable('seed_notes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Seeds', [
            'foreignKey' => 'seed_note_id',
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
            ->scalar('class')
            ->maxLength('class', 45)
            ->allowEmptyString('class');

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

        $rules->addDelete(function ($entity, $options) {
            $seeds = $this->Seeds->find()->where(['seed_note_id' => $entity->id])->count();
            return $seeds == 0;
        }, 'hasSeeds', ['errorField' => 'Seeds', 'message' => 'Esta Nota possui Sementes vinculadas']);

        return $rules;
    }
}
