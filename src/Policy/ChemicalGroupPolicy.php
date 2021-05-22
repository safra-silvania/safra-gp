<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalGroup;
use Authorization\IdentityInterface;

/**
 * ChemicalGroup policy
 */
class ChemicalGroupPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalGroup $chemicalGroup)
    {
        return true;
    }

    /**
     * Check if $user can create ChemicalGroup
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalGroup $chemicalGroup
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalGroup $chemicalGroup)
    {
        return true;
    }

    /**
     * Check if $user can update ChemicalGroup
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalGroup $chemicalGroup
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalGroup $chemicalGroup)
    {
        return true;
    }

    /**
     * Check if $user can delete ChemicalGroup
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalGroup $chemicalGroup
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalGroup $chemicalGroup)
    {
        return true;
    }

    /**
     * Check if $user can view ChemicalGroup
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalGroup $chemicalGroup
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalGroup $chemicalGroup)
    {
        return true;
    }
}
