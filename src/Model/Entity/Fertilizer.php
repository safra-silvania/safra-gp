<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fertilizer Entity
 *
 * @property int $id
 * @property string $name
 * @property int $supplier_id
 * @property string $formula
 * @property string|null $increment
 * @property int|null $fertilizer_measure_unit_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\FertilizerMeasureUnit $fertilizer_measure_unit
 */
class Fertilizer extends Entity
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
        'supplier_id' => true,
        'formula' => true,
        'increment' => true,
        'fertilizer_measure_unit_id' => true,
        'created' => true,
        'modified' => true,
        'supplier' => true,
        'fertilizer_measure_unit' => true,
    ];
}
