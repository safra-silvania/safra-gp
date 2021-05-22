<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\City;
use Authorization\IdentityInterface;

/**
 * City policy
 */
class CityPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, City $city)
    {
        return true;
    }
    
    /**
     * Check if $user can create City
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\City $city
     * @return bool
     */
    public function canCreate(IdentityInterface $user, City $city)
    {
        return true;
    }

    /**
     * Check if $user can update City
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\City $city
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, City $city)
    {
        return true;
    }

    /**
     * Check if $user can delete City
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\City $city
     * @return bool
     */
    public function canDelete(IdentityInterface $user, City $city)
    {
        return true;
    }

    /**
     * Check if $user can view City
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\City $city
     * @return bool
     */
    public function canView(IdentityInterface $user, City $city)
    {
        return true;
    }
}
