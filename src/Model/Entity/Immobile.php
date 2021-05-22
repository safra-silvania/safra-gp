<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Immobile Entity
 *
 * @property int $id
 * @property int $producer_id
 * @property string $harvest
 * @property int $city_id
 * @property string $name
 * @property string|null $observations
 *
 * @property \App\Model\Entity\Producer $producer
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Field[] $fields
 * @property \App\Model\Entity\Plan[] $plans
 */
class Immobile extends Entity
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
        'producer_id' => true,
        'harvest' => true,
        'city_id' => true,
        'name' => true,
        'observations' => true,
        'producer' => true,
        'city' => true,
        'fields' => true,
        'plans' => true,
    ];
}
