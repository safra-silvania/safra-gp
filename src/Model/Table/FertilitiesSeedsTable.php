<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FertilitiesSeeds Model
 *
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\BelongsTo $Seeds
 * @property \App\Model\Table\FertilitiesTable&\Cake\ORM\Association\BelongsTo $Fertilities
 *
 * @method \App\Model\Entity\FertilitiesSeed newEmptyEntity()
 * @method \App\Model\Entity\FertilitiesSeed newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FertilitiesSeed[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FertilitiesSeed get($primaryKey, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FertilitiesSeed[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FertilitiesSeed|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FertilitiesSeed[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FertilitiesSeedsTable extends Table
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

        $this->setTable('fertilities_seeds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Seeds', [
            'foreignKey' => 'seed_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fertilities', [
            'foreignKey' => 'fertility_id',
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
        $rules->add($rules->existsIn(['seed_id'], 'Seeds'));
        $rules->add($rules->existsIn(['fertility_id'], 'Fertilities'));

        return $rules;
    }
}
