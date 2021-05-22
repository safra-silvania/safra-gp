<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 *
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\FieldsTable&\Cake\ORM\Association\HasMany $Fields
 * @property \App\Model\Table\ImmobilesTable&\Cake\ORM\Association\HasMany $Immobiles
 * @property \App\Model\Table\ProducersTable&\Cake\ORM\Association\HasMany $Producers
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\HasMany $Seeds
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\HasMany $Suppliers
 *
 * @method \App\Model\Entity\City newEmptyEntity()
 * @method \App\Model\Entity\City newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\City[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\City get($primaryKey, $options = [])
 * @method \App\Model\Entity\City findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\City patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\City[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\City|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\City saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CitiesTable extends Table
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

        $this->setTable('cities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Fields', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Immobiles', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Producers', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Seeds', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Suppliers', [
            'foreignKey' => 'city_id',
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
            ->notEmptyString('name');

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
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->isUnique(['name', 'state_id'], 'Este município já foi cadastrado no Estado'));

        $rules->addDelete(function ($entity, $options) {
            $suppliers = $this->Suppliers->find()->where(['city_id' => $entity->id])->count();
            return $suppliers == 0;
        }, 'hasSuppliers', ['errorField' => 'suppliers', 'message' => 'Este Município possui Fornecedores vinculados']);
        
        $rules->addDelete(function ($entity, $options) {
            $producers = $this->Producers->find()->where(['city_id' => $entity->id])->count();
            return $producers == 0;
        }, 'hasProducers', ['errorField' => 'Producers', 'message' => 'Este Município possui Produtores vinculados']);

        $rules->addDelete(function ($entity, $options) {
            $fields = $this->Fields->find()->where(['city_id' => $entity->id])->count();
            return $fields == 0;
        }, 'hasFields', ['errorField' => 'fields', 'message' => 'Este Município possui Talhões vinculados']);

        $rules->addDelete(function ($entity, $options) {
            $immobiles = $this->Immobiles->find()->where(['city_id' => $entity->id])->count();
            return $immobiles == 0;
        }, 'hasImmobiles', ['errorField' => 'immobiles', 'message' => 'Este Município possui Imóveis vinculados']);

        $rules->addDelete(function ($entity, $options) {
            $seeds = $this->Seeds->find()->where(['city_id' => $entity->id])->count();
            return $seeds == 0;
        }, 'hasSeeds', ['errorField' => 'seeds', 'message' => 'Este Município possui Sementes vinculadas']);

        return $rules;
    }
}
