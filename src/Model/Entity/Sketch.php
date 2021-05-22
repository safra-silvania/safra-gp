<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sketch Entity
 *
 * @property int $id
 * @property int|null $field_id
 * @property string|null $observations
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Field $field
 * @property \App\Model\Entity\File[] $files
 */
class Sketch extends Entity
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
        'field_id' => true,
        'observations' => true,
        'created' => true,
        'modified' => true,
        'field' => true,
        'files' => true,
    ];
}
