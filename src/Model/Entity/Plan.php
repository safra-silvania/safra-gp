<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int $id
 * @property int $immobile_id
 * @property int $plan_status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Immobile $immobile
 * @property \App\Model\Entity\PlanStatus $plan_status
 * @property \App\Model\Entity\PlanFieldDetail[] $plan_field_details
 * @property \App\Model\Entity\SelectedChemical[] $selected_chemicals
 * @property \App\Model\Entity\SelectedFertilizer[] $selected_fertilizers
 * @property \App\Model\Entity\SelectedSeed[] $selected_seeds
 */
class Plan extends Entity
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
        'immobile_id' => true,
        'plan_status_id' => true,
        'created' => true,
        'modified' => true,
        'immobile' => true,
        'plan_status' => true,
        'plan_field_details' => true,
        'selected_chemicals' => true,
        'selected_fertilizers' => true,
        'selected_seeds' => true,
    ];
}
