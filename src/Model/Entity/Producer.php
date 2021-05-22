<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Producer Entity
 *
 * @property int $id
 * @property string $name
 * @property string $document
 * @property string|null $phone_cel
 * @property string|null $phone_fix
 * @property int|null $city_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Immobile[] $immobiles
 */
class Producer extends Entity
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
        'document' => true,
        'phone_cel' => true,
        'phone_fix' => true,
        'city_id' => true,
        'created' => true,
        'modified' => true,
        'city' => true,
        'immobiles' => true,
    ];
}
