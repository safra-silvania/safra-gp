<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Cycle;
use Authorization\IdentityInterface;

/**
 * Cycle policy
 */
class CyclePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Cycle $cycle)
    {
        return true;
    }

    /**
     * Check if $user can create Cycle
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Cycle $cycle
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Cycle $cycle)
    {
        return true;
    }

    /**
     * Check if $user can update Cycle
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Cycle $cycle
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Cycle $cycle)
    {
        return true;
    }

    /**
     * Check if $user can delete Cycle
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Cycle $cycle
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Cycle $cycle)
    {
        return true;
    }

    /**
     * Check if $user can view Cycle
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Cycle $cycle
     * @return bool
     */
    public function canView(IdentityInterface $user, Cycle $cycle)
    {
        return true;
    }
}
