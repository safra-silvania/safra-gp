<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\FertilizerMeasureUnit;
use Authorization\IdentityInterface;

/**
 * FertilizerMeasureUnit policy
 */
class FertilizerMeasureUnitPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, FertilizerMeasureUnit $fertilizerMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can create FertilizerMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FertilizerMeasureUnit $fertilizerMeasureUnit
     * @return bool
     */
    public function canCreate(IdentityInterface $user, FertilizerMeasureUnit $fertilizerMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can update FertilizerMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FertilizerMeasureUnit $fertilizerMeasureUnit
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, FertilizerMeasureUnit $fertilizerMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can delete FertilizerMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FertilizerMeasureUnit $fertilizerMeasureUnit
     * @return bool
     */
    public function canDelete(IdentityInterface $user, FertilizerMeasureUnit $fertilizerMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can view FertilizerMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FertilizerMeasureUnit $fertilizerMeasureUnit
     * @return bool
     */
    public function canView(IdentityInterface $user, FertilizerMeasureUnit $fertilizerMeasureUnit)
    {
        return true;
    }
}
