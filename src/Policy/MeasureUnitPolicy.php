<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\MeasureUnit;
use Authorization\IdentityInterface;

/**
 * MeasureUnit policy
 */
class MeasureUnitPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, MeasureUnit $measureUnit)
    {
        return true;
    }
    
    /**
     * Check if $user can create MeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\MeasureUnit $measureUnit
     * @return bool
     */
    public function canCreate(IdentityInterface $user, MeasureUnit $measureUnit)
    {
        return true;
    }

    /**
     * Check if $user can update MeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\MeasureUnit $measureUnit
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, MeasureUnit $measureUnit)
    {
        return true;
    }

    /**
     * Check if $user can delete MeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\MeasureUnit $measureUnit
     * @return bool
     */
    public function canDelete(IdentityInterface $user, MeasureUnit $measureUnit)
    {
        return true;
    }

    /**
     * Check if $user can view MeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\MeasureUnit $measureUnit
     * @return bool
     */
    public function canView(IdentityInterface $user, MeasureUnit $measureUnit)
    {
        return true;
    }
}
