<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int|null $sketch_id
 * @property string $name
 * @property string $hash
 * @property string $path
 * @property string $type
 * @property string $extension
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Sketch $sketch
 */
class File extends Entity
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
        'sketch_id' => true,
        'name' => true,
        'hash' => true,
        'path' => true,
        'type' => true,
        'extension' => true,
        'created' => true,
        'modified' => true,
        'sketch' => true,
    ];
}
