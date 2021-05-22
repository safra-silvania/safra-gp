<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\PlanFieldDetail;
use Authorization\IdentityInterface;

/**
 * PlanFieldDetail policy
 */
class PlanFieldDetailPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, PlanFieldDetail $planFieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can create PlanFieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanFieldDetail $planFieldDetail
     * @return bool
     */
    public function canCreate(IdentityInterface $user, PlanFieldDetail $planFieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can update PlanFieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanFieldDetail $planFieldDetail
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, PlanFieldDetail $planFieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can delete PlanFieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanFieldDetail $planFieldDetail
     * @return bool
     */
    public function canDelete(IdentityInterface $user, PlanFieldDetail $planFieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can view PlanFieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\PlanFieldDetail $planFieldDetail
     * @return bool
     */
    public function canView(IdentityInterface $user, PlanFieldDetail $planFieldDetail)
    {
        return true;
    }
}
