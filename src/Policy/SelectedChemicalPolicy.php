<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SelectedChemical;
use Authorization\IdentityInterface;

/**
 * SelectedChemical policy
 */
class SelectedChemicalPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, SelectedChemical $selectedChemical)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create SelectedChemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedChemical $selectedChemical
     * @return bool
     */
    public function canCreate(IdentityInterface $user, SelectedChemical $selectedChemical)
    {
        return true;
    }

    /**
     * Check if $user can update SelectedChemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedChemical $selectedChemical
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, SelectedChemical $selectedChemical)
    {
        return true;
    }

    /**
     * Check if $user can delete SelectedChemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedChemical $selectedChemical
     * @return bool
     */
    public function canDelete(IdentityInterface $user, SelectedChemical $selectedChemical)
    {
        return true;
    }

    /**
     * Check if $user can view SelectedChemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedChemical $selectedChemical
     * @return bool
     */
    public function canView(IdentityInterface $user, SelectedChemical $selectedChemical)
    {
        return true;
    }
}
