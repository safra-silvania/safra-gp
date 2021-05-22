<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Fertility;
use Authorization\IdentityInterface;

/**
 * Fertility policy
 */
class FertilityPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Fertility $fertility)
    {
        return true;
    }
    
    /**
     * Check if $user can create Fertility
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertility $fertility
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Fertility $fertility)
    {
        return true;
    }

    /**
     * Check if $user can update Fertility
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertility $fertility
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Fertility $fertility)
    {
        return true;
    }

    /**
     * Check if $user can delete Fertility
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertility $fertility
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Fertility $fertility)
    {
        return true;
    }

    /**
     * Check if $user can view Fertility
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertility $fertility
     * @return bool
     */
    public function canView(IdentityInterface $user, Fertility $fertility)
    {
        return true;
    }
}
