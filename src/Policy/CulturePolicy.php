<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Culture;
use Authorization\IdentityInterface;

/**
 * Culture policy
 */
class CulturePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Culture $culture)
    {
        return true;
    }
    
    /**
     * Check if $user can create Culture
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Culture $culture
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Culture $culture)
    {
        return true;
    }

    /**
     * Check if $user can update Culture
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Culture $culture
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Culture $culture)
    {
        return true;
    }

    /**
     * Check if $user can delete Culture
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Culture $culture
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Culture $culture)
    {
        return true;
    }

    /**
     * Check if $user can view Culture
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Culture $culture
     * @return bool
     */
    public function canView(IdentityInterface $user, Culture $culture)
    {
        return true;
    }
}
