<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SelectedSeed Entity
 *
 * @property int $id
 * @property int $seed_id
 * @property int $plan_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Seed $seed
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\PlanFieldDetail[] $plan_field_details
 */
class SelectedSeed extends Entity
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
        'seed_id' => true,
        'plan_id' => true,
        'created' => true,
        'modified' => true,
        'seed' => true,
        'plan' => true,
        'plan_field_details' => true,
    ];
}
