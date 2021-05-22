<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Producers Model
 *
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\ImmobilesTable&\Cake\ORM\Association\HasMany $Immobiles
 *
 * @method \App\Model\Entity\Producer newEmptyEntity()
 * @method \App\Model\Entity\Producer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Producer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Producer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Producer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Producer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Producer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Producer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProducersTable extends Table
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

        $this->setTable('producers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Immobiles', [
            'foreignKey' => 'producer_id',
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
            ->scalar('document')
            ->maxLength('document', 45)
            ->requirePresence('document', 'create')
            ->notEmptyString('document')
            ->add('document', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('phone_cel')
            ->maxLength('phone_cel', 45)
            ->allowEmptyString('phone_cel');

        $validator
            ->scalar('phone_fix')
            ->maxLength('phone_fix', 45)
            ->allowEmptyString('phone_fix');

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
        $rules->add($rules->isUnique(['document']));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        $rules->addDelete(function ($entity, $options) {
            $immobiles = $this->Immobiles->find()->where(['producer_id' => $entity->id])->count();
            return $immobiles == 0;
        }, 'hasImmobiles', ['errorField' => 'immobiles', 'message' => 'Este Produtor possui Imóveis vinculados']);

        return $rules;
    }
}
