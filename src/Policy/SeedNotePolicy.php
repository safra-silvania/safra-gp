<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SeedNote;
use Authorization\IdentityInterface;

/**
 * SeedNote policy
 */
class SeedNotePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, SeedNote $seedNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create SeedNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SeedNote $seedNote
     * @return bool
     */
    public function canCreate(IdentityInterface $user, SeedNote $seedNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update SeedNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SeedNote $seedNote
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, SeedNote $seedNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete SeedNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SeedNote $seedNote
     * @return bool
     */
    public function canDelete(IdentityInterface $user, SeedNote $seedNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view SeedNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SeedNote $seedNote
     * @return bool
     */
    public function canView(IdentityInterface $user, SeedNote $seedNote)
    {
        return $this->isDeveloper($user);
    }
}
