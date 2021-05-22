<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Technology;
use Authorization\IdentityInterface;

/**
 * Technology policy
 */
class TechnologyPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Technology $technology)
    {
        return true;
    }

    /**
     * Check if $user can create Technology
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Technology $technology
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Technology $technology)
    {
        return true;
    }

    /**
     * Check if $user can update Technology
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Technology $technology
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Technology $technology)
    {
        return true;
    }

    /**
     * Check if $user can delete Technology
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Technology $technology
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Technology $technology)
    {
        return true;
    }

    /**
     * Check if $user can view Technology
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Technology $technology
     * @return bool
     */
    public function canView(IdentityInterface $user, Technology $technology)
    {
        return true;
    }
}
