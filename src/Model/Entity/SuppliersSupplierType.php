<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SuppliersSupplierType Entity
 *
 * @property int $id
 * @property int $supplier_id
 * @property int $supplier_type_id
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\SupplierType $supplier_type
 */
class SuppliersSupplierType extends Entity
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
        'supplier_id' => true,
        'supplier_type_id' => true,
        'supplier' => true,
        'supplier_type' => true,
    ];
}
