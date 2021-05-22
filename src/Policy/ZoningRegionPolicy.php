<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ZoningRegion;
use Authorization\IdentityInterface;

/**
 * ZoningRegion policy
 */
class ZoningRegionPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ZoningRegion $zoningRegion)
    {
        return $this->isDeveloper($user);
    }
    /**
     * Check if $user can create ZoningRegion
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ZoningRegion $zoningRegion
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ZoningRegion $zoningRegion)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update ZoningRegion
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ZoningRegion $zoningRegion
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ZoningRegion $zoningRegion)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete ZoningRegion
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ZoningRegion $zoningRegion
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ZoningRegion $zoningRegion)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view ZoningRegion
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ZoningRegion $zoningRegion
     * @return bool
     */
    public function canView(IdentityInterface $user, ZoningRegion $zoningRegion)
    {
        return $this->isDeveloper($user);
    }
}
