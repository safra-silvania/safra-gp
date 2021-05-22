<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Seed;
use Authorization\IdentityInterface;

/**
 * Seed policy
 */
class SeedPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Seed $seed)
    {
        return true;
    }
    
    /**
     * Check if $user can create Seed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Seed $seed
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Seed $seed)
    {
        return true;
    }

    /**
     * Check if $user can update Seed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Seed $seed
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Seed $seed)
    {
        return true;
    }

    /**
     * Check if $user can delete Seed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Seed $seed
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Seed $seed)
    {
        return true;
    }

    /**
     * Check if $user can view Seed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Seed $seed
     * @return bool
     */
    public function canView(IdentityInterface $user, Seed $seed)
    {
        return true;
    }
}
