<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use Authorization\IdentityInterface;

/**
 * File policy
 */
class FilePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, File $file)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create File
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\File $file
     * @return bool
     */
    public function canCreate(IdentityInterface $user, File $file)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update File
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\File $file
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, File $file)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete File
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\File $file
     * @return bool
     */
    public function canDelete(IdentityInterface $user, File $file)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view File
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\File $file
     * @return bool
     */
    public function canView(IdentityInterface $user, File $file)
    {
        return $this->isDeveloper($user);
    }
}
