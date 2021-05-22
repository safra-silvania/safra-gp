<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalClass;
use Authorization\IdentityInterface;

/**
 * ChemicalClass policy
 */
class ChemicalClassPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalClass $chemicalClass)
    {
        return true;
    }

    /**
     * Check if $user can create ChemicalClass
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalClass $chemicalClass
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalClass $chemicalClass)
    {
        return true;
    }

    /**
     * Check if $user can update ChemicalClass
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalClass $chemicalClass
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalClass $chemicalClass)
    {
        return true;
    }

    /**
     * Check if $user can delete ChemicalClass
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalClass $chemicalClass
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalClass $chemicalClass)
    {
        return true;
    }

    /**
     * Check if $user can view ChemicalClass
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalClass $chemicalClass
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalClass $chemicalClass)
    {
        return true;
    }
}
