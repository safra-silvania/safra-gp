<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Fertilizer;
use Authorization\IdentityInterface;

/**
 * Fertilizer policy
 */
class FertilizerPolicy extends Base\BasePolicy
{
    
    public function canAccess(IdentityInterface $user, Fertilizer $fertilizer)
    {
        return true;
    }

    /**
     * Check if $user can create Fertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertilizer $fertilizer
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Fertilizer $fertilizer)
    {
        return true;
    }

    /**
     * Check if $user can update Fertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertilizer $fertilizer
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Fertilizer $fertilizer)
    {
        return true;
    }

    /**
     * Check if $user can delete Fertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertilizer $fertilizer
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Fertilizer $fertilizer)
    {
        return true;
    }

    /**
     * Check if $user can view Fertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Fertilizer $fertilizer
     * @return bool
     */
    public function canView(IdentityInterface $user, Fertilizer $fertilizer)
    {
        return true;
    }
}
