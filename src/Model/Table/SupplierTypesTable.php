<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SupplierTypes Model
 *
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsToMany $Suppliers
 *
 * @method \App\Model\Entity\SupplierType newEmptyEntity()
 * @method \App\Model\Entity\SupplierType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SupplierType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SupplierType get($primaryKey, $options = [])
 * @method \App\Model\Entity\SupplierType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SupplierType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SupplierType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SupplierType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SupplierType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SupplierType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SupplierType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SupplierType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SupplierType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SupplierTypesTable extends Table
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

        $this->setTable('supplier_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Suppliers', [
            'foreignKey' => 'supplier_type_id',
            'targetForeignKey' => 'supplier_id',
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
            return $this->Suppliers->find()->where(['supplier_id' => $entity->id])->count() == 0;
        }, 'hasSuppliers', ['errorField' => 'Suppliers', 'message' => 'Este Tipo possui Fornecedores vinculados']);

        return $rules;
    }
}
