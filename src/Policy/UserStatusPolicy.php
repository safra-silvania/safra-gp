<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\UserStatus;
use Authorization\IdentityInterface;

/**
 * UserStatus policy
 */
class UserStatusPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, UserStatus $userStatus)
    {
        return false;
    }

    /**
     * Check if $user can create UserStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\UserStatus $userStatus
     * @return bool
     */
    public function canCreate(IdentityInterface $user, UserStatus $userStatus)
    {
        return false;
    }

    /**
     * Check if $user can update UserStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\UserStatus $userStatus
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, UserStatus $userStatus)
    {
        return false;
    }

    /**
     * Check if $user can delete UserStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\UserStatus $userStatus
     * @return bool
     */
    public function canDelete(IdentityInterface $user, UserStatus $userStatus)
    {
        return false;
    }

    /**
     * Check if $user can view UserStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\UserStatus $userStatus
     * @return bool
     */
    public function canView(IdentityInterface $user, UserStatus $userStatus)
    {
        return false;
    }
}
