<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ChemicalNote;
use Authorization\IdentityInterface;

/**
 * ChemicalNote policy
 */
class ChemicalNotePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ChemicalNote $chemicalNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create ChemicalNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalNote $chemicalNote
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ChemicalNote $chemicalNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update ChemicalNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalNote $chemicalNote
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ChemicalNote $chemicalNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete ChemicalNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalNote $chemicalNote
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ChemicalNote $chemicalNote)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view ChemicalNote
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ChemicalNote $chemicalNote
     * @return bool
     */
    public function canView(IdentityInterface $user, ChemicalNote $chemicalNote)
    {
        return $this->isDeveloper($user);
    }
}
