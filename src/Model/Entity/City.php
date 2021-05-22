<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Field[] $fields
 * @property \App\Model\Entity\Immobile[] $immobiles
 * @property \App\Model\Entity\Producer[] $producers
 * @property \App\Model\Entity\Seed[] $seeds
 * @property \App\Model\Entity\Supplier[] $suppliers
 */
class City extends Entity
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
        'state_id' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
        'fields' => true,
        'immobiles' => true,
        'producers' => true,
        'seeds' => true,
        'suppliers' => true,
    ];
}
