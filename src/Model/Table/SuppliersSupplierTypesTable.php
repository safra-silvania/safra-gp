<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SuppliersSupplierTypes Model
 *
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\SupplierTypesTable&\Cake\ORM\Association\BelongsTo $SupplierTypes
 *
 * @method \App\Model\Entity\SuppliersSupplierType newEmptyEntity()
 * @method \App\Model\Entity\SuppliersSupplierType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType get($primaryKey, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SuppliersSupplierType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SuppliersSupplierTypesTable extends Table
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

        $this->setTable('suppliers_supplier_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SupplierTypes', [
            'foreignKey' => 'supplier_type_id',
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
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));
        $rules->add($rules->existsIn(['supplier_type_id'], 'SupplierTypes'));

        return $rules;
    }
}
