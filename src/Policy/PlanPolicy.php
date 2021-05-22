<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Plan;
use Authorization\IdentityInterface;

/**
 * Plan policy
 */
class PlanPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Plan $plan)
    {
        return true;
    }

    /**
     * Check if $user can create Plan
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Plan $plan
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Plan $plan)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update Plan
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Plan $plan
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Plan $plan)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete Plan
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Plan $plan
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Plan $plan)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view Plan
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Plan $plan
     * @return bool
     */
    public function canView(IdentityInterface $user, Plan $plan)
    {
        return true;
    }
}
