<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalActionMode;
use Authorization\IdentityInterface;

/**
 * ChemicalActionMode policy
 */
class ChemicalActionModePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalActionMode $chemicalActionMode)
    {
        return true;
    }

    /**
     * Check if $user can create ChemicalActionMode
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalActionMode $chemicalActionMode
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalActionMode $chemicalActionMode)
    {
        return true;
    }

    /**
     * Check if $user can update ChemicalActionMode
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalActionMode $chemicalActionMode
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalActionMode $chemicalActionMode)
    {
        return true;
    }

    /**
     * Check if $user can delete ChemicalActionMode
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalActionMode $chemicalActionMode
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalActionMode $chemicalActionMode)
    {
        return true;
    }

    /**
     * Check if $user can view ChemicalActionMode
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalActionMode $chemicalActionMode
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalActionMode $chemicalActionMode)
    {
        return true;
    }
}
