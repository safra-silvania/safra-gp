<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SelectedFertilizer Entity
 *
 * @property int $id
 * @property int $fertilizer_id
 * @property int $plan_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Fertilizer $fertilizer
 * @property \App\Model\Entity\Plan $plan
 */
class SelectedFertilizer extends Entity
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
        'fertilizer_id' => true,
        'plan_id' => true,
        'created' => true,
        'modified' => true,
        'fertilizer' => true,
        'plan' => true,
    ];
}
