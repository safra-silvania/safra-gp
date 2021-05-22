<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chemical Entity
 *
 * @property int $id
 * @property int $chemical_note_id
 * @property string $name
 * @property int $chemical_class_id
 * @property int $supplier_id
 * @property string $dose
 * @property int $chemical_measure_unit_id
 * @property int $chemical_target_id
 * @property string|null $incompatibility
 * @property string|null $observation
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ChemicalNote $chemical_note
 * @property \App\Model\Entity\ChemicalClass $chemical_class
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\ChemicalMeasureUnit $chemical_measure_unit
 * @property \App\Model\Entity\ChemicalTarget $chemical_target
 * @property \App\Model\Entity\ApplicationSeason[] $application_seasons
 * @property \App\Model\Entity\ChemicalActionMode[] $chemical_action_modes
 * @property \App\Model\Entity\ChemicalGroup[] $chemical_groups
 * @property \App\Model\Entity\Culture[] $cultures
 */
class Chemical extends Entity
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
        'chemical_note_id' => true,
        'name' => true,
        'chemical_class_id' => true,
        'supplier_id' => true,
        'dose' => true,
        'chemical_measure_unit_id' => true,
        'chemical_target_id' => true,
        'incompatibility' => true,
        'observation' => true,
        'created' => true,
        'modified' => true,
        'chemical_note' => true,
        'chemical_class' => true,
        'supplier' => true,
        'chemical_measure_unit' => true,
        'chemical_target' => true,
        'application_seasons' => true,
        'chemical_action_modes' => true,
        'chemical_groups' => true,
        'cultures' => true,
    ];
}
