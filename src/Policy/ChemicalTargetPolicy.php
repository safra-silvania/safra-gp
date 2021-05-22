<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalTarget;
use Authorization\IdentityInterface;

/**
 * ChemicalTarget policy
 */
class ChemicalTargetPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalTarget $chemicalTarget)
    {
        return true;
    }

    /**
     * Check if $user can create ChemicalTarget
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalTarget $chemicalTarget
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalTarget $chemicalTarget)
    {
        return true;
    }

    /**
     * Check if $user can update ChemicalTarget
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalTarget $chemicalTarget
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalTarget $chemicalTarget)
    {
        return true;
    }

    /**
     * Check if $user can delete ChemicalTarget
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalTarget $chemicalTarget
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalTarget $chemicalTarget)
    {
        return true;
    }

    /**
     * Check if $user can view ChemicalTarget
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalTarget $chemicalTarget
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalTarget $chemicalTarget)
    {
        return true;
    }
}
