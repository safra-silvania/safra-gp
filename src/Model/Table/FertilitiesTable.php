<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fertilities Model
 *
 * @property \App\Model\Table\FieldDetailsTable&\Cake\ORM\Association\HasMany $FieldDetails
 * @property \App\Model\Table\FieldsTable&\Cake\ORM\Association\HasMany $Fields
 * @property \App\Model\Table\SeedsTable&\Cake\ORM\Association\BelongsToMany $Seeds
 *
 * @method \App\Model\Entity\Fertility newEmptyEntity()
 * @method \App\Model\Entity\Fertility newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fertility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fertility get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fertility findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fertility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fertility[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fertility|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fertility saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fertility[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fertility[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fertility[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fertility[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FertilitiesTable extends Table
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

        $this->setTable('fertilities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('FieldDetails', [
            'foreignKey' => 'fertility_id',
        ]);
        $this->hasMany('Fields', [
            'foreignKey' => 'fertility_id',
        ]);
        $this->belongsToMany('Seeds', [
            'foreignKey' => 'fertility_id',
            'targetForeignKey' => 'seed_id',
            'joinTable' => 'fertilities_seeds',
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
            $fields = $this->Fields->find()->where(['fertility_id' => $entity->id])->count();
            return $fields == 0;
        }, 'hasFields', ['errorField' => 'fields', 'message' => 'Esta Fertilidade possui Talhões vinculados']);

        $rules->addDelete(function ($entity, $options) {
            $fieldDetails = $this->FieldDetails->find()->where(['fertility_id' => $entity->id])->count();
            return $fieldDetails == 0;
        }, 'hasFieldDetails', ['errorField' => 'fieldDetails', 'message' => 'Esta Fertilidade possui Culturas de Talhão vinculadas']);

        //@todo: 
        // $rules->addDelete(function ($entity, $options) {
        //     $fertilitiesSeed = $this->FertilitiesSeed->find()->where(['fertility_id' => $entity->id])->count();
        //     return $fertilitiesSeed == 0;
        // }, 'hasFertilitiesSeed', ['errorFertilitiesSeed' => 'seeds', 'message' => 'Esta Fertilidade possui Sementes vinculadas']);

        return $rules;
    }
}
