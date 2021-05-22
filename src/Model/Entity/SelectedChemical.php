<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SelectedChemical Entity
 *
 * @property int $id
 * @property int $chemical_id
 * @property int $plan_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Chemical $chemical
 * @property \App\Model\Entity\Plan $plan
 */
class SelectedChemical extends Entity
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
        'chemical_id' => true,
        'plan_id' => true,
        'created' => true,
        'modified' => true,
        'chemical' => true,
        'plan' => true,
    ];
}
