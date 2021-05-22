<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Supplier Entity
 *
 * @property int $id
 * @property string $name
 * @property string $resale
 * @property int $city_id
 * @property string|null $representative
 * @property string|null $representative_phone
 * @property string|null $resale_phone
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Chemical[] $chemicals
 * @property \App\Model\Entity\Fertility[] $fertilities
 * @property \App\Model\Entity\Fertilizer[] $fertilizers
 * @property \App\Model\Entity\Seed[] $seeds
 * @property \App\Model\Entity\SupplierType[] $supplier_types
 */
class Supplier extends Entity
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
        'name' => true,
        'resale' => true,
        'city_id' => true,
        'representative' => true,
        'representative_phone' => true,
        'resale_phone' => true,
        'created' => true,
        'modified' => true,
        'city' => true,
        'chemicals' => true,
        'fertilities' => true,
        'fertilizers' => true,
        'seeds' => true,
        'supplier_types' => true,
    ];
}
