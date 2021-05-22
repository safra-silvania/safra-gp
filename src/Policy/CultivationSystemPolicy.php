<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\CultivationSystem;
use Authorization\IdentityInterface;

/**
 * CultivationSystem policy
 */
class CultivationSystemPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, CultivationSystem $cultivationSystem)
    {
        return true;
    }
    
    /**
     * Check if $user can create CultivationSystem
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\CultivationSystem $cultivationSystem
     * @return bool
     */
    public function canCreate(IdentityInterface $user, CultivationSystem $cultivationSystem)
    {
        return true;
    }

    /**
     * Check if $user can update CultivationSystem
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\CultivationSystem $cultivationSystem
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, CultivationSystem $cultivationSystem)
    {
        return true;
    }

    /**
     * Check if $user can delete CultivationSystem
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\CultivationSystem $cultivationSystem
     * @return bool
     */
    public function canDelete(IdentityInterface $user, CultivationSystem $cultivationSystem)
    {
        return true;
    }

    /**
     * Check if $user can view CultivationSystem
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\CultivationSystem $cultivationSystem
     * @return bool
     */
    public function canView(IdentityInterface $user, CultivationSystem $cultivationSystem)
    {
        return true;
    }
}
