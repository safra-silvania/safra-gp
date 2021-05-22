<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalMeasureUnit;
use Authorization\IdentityInterface;

/**
 * ChemicalMeasureUnit policy
 */
class ChemicalMeasureUnitPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalMeasureUnit $chemicalMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can create ChemicalMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalMeasureUnit $chemicalMeasureUnit
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalMeasureUnit $chemicalMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can update ChemicalMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalMeasureUnit $chemicalMeasureUnit
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalMeasureUnit $chemicalMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can delete ChemicalMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalMeasureUnit $chemicalMeasureUnit
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalMeasureUnit $chemicalMeasureUnit)
    {
        return true;
    }

    /**
     * Check if $user can view ChemicalMeasureUnit
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalMeasureUnit $chemicalMeasureUnit
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalMeasureUnit $chemicalMeasureUnit)
    {
        return true;
    }
}
