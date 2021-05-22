<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FieldDetail Entity
 *
 * @property int $id
 * @property int $field_id
 * @property int $culture_id
 * @property int $fertility_id
 * @property string $area
 * @property int $measure_unit_id
 * @property string|null $observations
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Field $field
 * @property \App\Model\Entity\Culture $culture
 * @property \App\Model\Entity\Fertility $fertility
 * @property \App\Model\Entity\MeasureUnit $measure_unit
 * @property \App\Model\Entity\PlanFieldDetail[] $plan_field_details
 */
class FieldDetail extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'field_id' => true,
        'culture_id' => true,
        'fertility_id' => true,
        'area' => true,
        'measure_unit_id' => true,
        'observations' => true,
        'created' => true,
        'modified' => true,
        'field' => true,
        'culture' => true,
        'fertility' => true,
        'measure_unit' => true,
        'plan_field_details' => true,
    ];
}
