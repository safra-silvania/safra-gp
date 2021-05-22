<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalApplicationSeason;
use Authorization\IdentityInterface;

/**
 * ChemicalApplicationSeason policy
 */
class ChemicalApplicationSeasonPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalApplicationSeason $chemicalApplicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can create ChemicalApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalApplicationSeason $chemicalApplicationSeason
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalApplicationSeason $chemicalApplicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can update ChemicalApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalApplicationSeason $chemicalApplicationSeason
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalApplicationSeason $chemicalApplicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can delete ChemicalApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalApplicationSeason $chemicalApplicationSeason
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalApplicationSeason $chemicalApplicationSeason)
    {
        return true;
    }

    /**
     * Check if $user can view ChemicalApplicationSeason
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalApplicationSeason $chemicalApplicationSeason
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalApplicationSeason $chemicalApplicationSeason)
    {
        return true;
    }
}
