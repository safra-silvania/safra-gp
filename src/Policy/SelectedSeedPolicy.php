<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SelectedSeed;
use Authorization\IdentityInterface;

/**
 * SelectedSeed policy
 */
class SelectedSeedPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, SelectedSeed $selectedSeed)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create SelectedSeed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedSeed $selectedSeed
     * @return bool
     */
    public function canCreate(IdentityInterface $user, SelectedSeed $selectedSeed)
    {
        return true;
    }

    /**
     * Check if $user can update SelectedSeed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedSeed $selectedSeed
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, SelectedSeed $selectedSeed)
    {
        return true;
    }

    /**
     * Check if $user can delete SelectedSeed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedSeed $selectedSeed
     * @return bool
     */
    public function canDelete(IdentityInterface $user, SelectedSeed $selectedSeed)
    {
        return true;
    }

    /**
     * Check if $user can view SelectedSeed
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedSeed $selectedSeed
     * @return bool
     */
    public function canView(IdentityInterface $user, SelectedSeed $selectedSeed)
    {
        return true;
    }
}
