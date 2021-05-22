<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Seed Entity
 *
 * @property int $id
 * @property int $seed_note_id
 * @property int $culture_id
 * @property int $variety_id
 * @property int $technology_id
 * @property string $maturation_group
 * @property int $cycle_days
 * @property int $cycle_id
 * @property int $zoning_region_id
 * @property int|null $productive_potencial_id
 * @property string|null $resistency
 * @property string|null $population
 * @property int|null $city_id
 * @property int|null $supplier_id
 * @property string|null $observations
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\SeedNote $seed_note
 * @property \App\Model\Entity\Culture $culture
 * @property \App\Model\Entity\Variety $variety
 * @property \App\Model\Entity\Technology $technology
 * @property \App\Model\Entity\Cycle $cycle
 * @property \App\Model\Entity\ZoningRegion $zoning_region
 * @property \App\Model\Entity\ProductivePotencial $productive_potencial
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Fertility[] $fertilities
 */
class Seed extends Entity
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
        'seed_note_id' => true,
        'culture_id' => true,
        'variety_id' => true,
        'technology_id' => true,
        'maturation_group' => true,
        'cycle_days' => true,
        'cycle_id' => true,
        'zoning_region_id' => true,
        'productive_potencial_id' => true,
        'resistency' => true,
        'population' => true,
        'city_id' => true,
        'supplier_id' => true,
        'observations' => true,
        'created' => true,
        'modified' => true,
        'seed_note' => true,
        'culture' => true,
        'variety' => true,
        'technology' => true,
        'cycle' => true,
        'zoning_region' => true,
        'productive_potencial' => true,
        'city' => true,
        'supplier' => true,
        'fertilities' => true,
    ];
}
