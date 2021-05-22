<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Immobile;
use Authorization\IdentityInterface;

/**
 * Immobile policy
 */
class ImmobilePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Immobile $immobile)
    {
        return true;
    }
    
    /**
     * Check if $user can create Immobile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Immobile $immobile
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Immobile $immobile)
    {
        return true;
    }

    /**
     * Check if $user can update Immobile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Immobile $immobile
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Immobile $immobile)
    {
        return true;
    }

    /**
     * Check if $user can delete Immobile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Immobile $immobile
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Immobile $immobile)
    {
        return true;
    }

    /**
     * Check if $user can view Immobile
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Immobile $immobile
     * @return bool
     */
    public function canView(IdentityInterface $user, Immobile $immobile)
    {
        return true;
    }
}
