<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ApplicationSeason;
use Authorization\IdentityInterface;

/**
 * ApplicationSeason policy
 */
class ApplicationSeasonPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ApplicationSeason $applicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can create ApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ApplicationSeason $applicationSeason
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ApplicationSeason $applicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can update ApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ApplicationSeason $applicationSeason
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ApplicationSeason $applicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can delete ApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ApplicationSeason $applicationSeason
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ApplicationSeason $applicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can view ApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ApplicationSeason $applicationSeason
     * @return bool
     */
    public function canView(IdentityInterface $user, ApplicationSeason $applicationSeason)
    {
        return true;
    }
}
