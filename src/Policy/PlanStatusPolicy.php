<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\PlanStatus;
use Authorization\IdentityInterface;

/**
 * PlanStatus policy
 */
class PlanStatusPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, PlanStatus $planStatus)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create PlanStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanStatus $planStatus
     * @return bool
     */
    public function canCreate(IdentityInterface $user, PlanStatus $planStatus)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update PlanStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanStatus $planStatus
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, PlanStatus $planStatus)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete PlanStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanStatus $planStatus
     * @return bool
     */
    public function canDelete(IdentityInterface $user, PlanStatus $planStatus)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view PlanStatus
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanStatus $planStatus
     * @return bool
     */
    public function canView(IdentityInterface $user, PlanStatus $planStatus)
    {
        return $this->isDeveloper($user);
    }
}
