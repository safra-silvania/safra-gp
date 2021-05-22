<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Variety;
use Authorization\IdentityInterface;

/**
 * Variety policy
 */
class VarietyPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Variety $variety)
    {
        return true;
    }

    /**
     * Check if $user can create Variety
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Variety $variety
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Variety $variety)
    {
        return true;
    }

    /**
     * Check if $user can update Variety
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Variety $variety
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Variety $variety)
    {
        return true;
    }

    /**
     * Check if $user can delete Variety
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Variety $variety
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Variety $variety)
    {
        return true;
    }

    /**
     * Check if $user can view Variety
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Variety $variety
     * @return bool
     */
    public function canView(IdentityInterface $user, Variety $variety)
    {
        return true;
    }
}
