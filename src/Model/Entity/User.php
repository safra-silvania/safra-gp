<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use App\Model\Enum;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property int $user_status_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\UserStatus $user_status
 * @property \App\Model\Entity\Notification[] $notifications
 */
class User extends Entity
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
        'role_id' => true,
        'user_status_id' => true,
        'name' => true,
        'email' => true,
        'password' => true,
        'password_confirm' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'user_status' => true,
        'notifications' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'password_confirm',
    ];

    public function isActive()
    {
        return $this->user_status_id == Enum\UserStatusEnum::Ativo;
    }
    
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }

        return null;
    }
}
