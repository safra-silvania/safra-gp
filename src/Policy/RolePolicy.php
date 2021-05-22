<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Role;
use Authorization\IdentityInterface;

/**
 * Role policy
 */
class RolePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Role $role)
    {
        return true;
    }

    /**
     * Check if $user can create Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Role $role)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Role $role)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Role $role)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canView(IdentityInterface $user, Role $role)
    {
        return $this->isDeveloper($user);
    }
}
