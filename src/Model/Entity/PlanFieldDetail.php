<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlanFieldDetail Entity
 *
 * @property int $id
 * @property int $field_detail_id
 * @property int $plan_id
 * @property int|null $selected_seed_id
 * @property int $sequence
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\FieldDetail $field_detail
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\SelectedSeed $selected_seed
 */
class PlanFieldDetail extends Entity
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
        'field_detail_id' => true,
        'plan_id' => true,
        'selected_seed_id' => true,
        'sequence' => true,
        'population' => true,
        'created' => true,
        'modified' => true,
        'field_detail' => true,
        'plan' => true,
        'selected_seed' => true,
    ];
}
