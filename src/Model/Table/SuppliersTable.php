<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suppliers Model
 *
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\ChemicalsTable&\Cake\ORM\Association\HasMany $Chemicals
 * @property \App\Model\Table\FertilitiesTable&\Cake\ORM\Association\HasMany $Fertilities
 * @property \App\Model\Table\FertilizersTable&\Cake\ORM\Association\HasMany $Fertilizers
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\HasMany $Seeds
 * @property \App\Model\Table\SupplierTypesTable&\Cake\ORM\Association\BelongsToMany $SupplierTypes
 *
 * @method \App\Model\Entity\Supplier newEmptyEntity()
 * @method \App\Model\Entity\Supplier newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Supplier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Supplier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Supplier findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Supplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SuppliersTable extends Table
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

        $this->setTable('suppliers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Chemicals', [
            'foreignKey' => 'supplier_id',
        ]);
        $this->hasMany('Fertilities', [
            'foreignKey' => 'supplier_id',
        ]);
        $this->hasMany('Fertilizers', [
            'foreignKey' => 'supplier_id',
        ]);
        $this->hasMany('Seeds', [
            'foreignKey' => 'supplier_id',
        ]);
        $this->belongsToMany('SupplierTypes', [
            'foreignKey' => 'supplier_id',
            'targetForeignKey' => 'supplier_type_id',
            'joinTable' => 'suppliers_supplier_types',
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
            ->scalar('resale')
            ->maxLength('resale', 255)
            ->requirePresence('resale', 'create')
            ->notEmptyString('resale');

        $validator
            ->scalar('representative')
            ->maxLength('representative', 255)
            ->allowEmptyString('representative');

        $validator
            ->scalar('representative_phone')
            ->maxLength('representative_phone', 45)
            ->allowEmptyString('representative_phone');

        $validator
            ->scalar('resale_phone')
            ->maxLength('resale_phone', 45)
            ->allowEmptyString('resale_phone');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        $rules->addDelete(function ($entity, $options) {
            return $this->Seeds->find()->where(['supplier_id' => $entity->id])->count() == 0;
        }, 'hasSeeds', ['errorField' => 'Seeds', 'message' => 'Este Fornecedor possui Sementes vinculadas']);

        $rules->addDelete(function ($entity, $options) {
            return $this->Chemicals->find()->where(['supplier_id' => $entity->id])->count() == 0;
        }, 'hasChemicals', ['errorField' => 'Chemicals', 'message' => 'Este Fornecedor possui Químicos vinculados']);

        $rules->addDelete(function ($entity, $options) {
            return $this->Fertilizers->find()->where(['supplier_id' => $entity->id])->count() == 0;
        }, 'hasFertilizers', ['errorField' => 'Fertilizers', 'message' => 'Este Fornecedor possui Adubos vinculados']);

        return $rules;
    }
}
