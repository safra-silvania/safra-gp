<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Field Entity
 *
 * @property int $id
 * @property int $immobile_id
 * @property string $name
 * @property string $total_area
 * @property int $measure_unit_id
 * @property int $cultivation_system_id
 * @property int $fertility_id
 * @property int $city_id
 * @property string|null $observations
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Immobile $immobile
 * @property \App\Model\Entity\MeasureUnit $measure_unit
 * @property \App\Model\Entity\CultivationSystem $cultivation_system
 * @property \App\Model\Entity\Fertility $fertility
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\FieldDetail[] $field_details
 * @property \App\Model\Entity\PlanField[] $plan_fields
 * @property \App\Model\Entity\Sketch[] $sketches
 */
class Field extends Entity
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
        'immobile_id' => true,
        'name' => true,
        'total_area' => true,
        'measure_unit_id' => true,
        'cultivation_system_id' => true,
        'fertility_id' => true,
        'city_id' => true,
        'observations' => true,
        'created' => true,
        'modified' => true,
        'immobile' => true,
        'measure_unit' => true,
        'cultivation_system' => true,
        'fertility' => true,
        'city' => true,
        'field_details' => true,
        'plan_fields' => true,
        'sketches' => true,
    ];
}
