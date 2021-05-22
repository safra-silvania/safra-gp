<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Chemical;
use Authorization\IdentityInterface;

/**
 * Chemical policy
 */
class ChemicalPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Chemical $chemical)
    {
        return true;
    }

    /**
     * Check if $user can create Chemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Chemical $chemical
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Chemical $chemical)
    {
        return true;
    }

    /**
     * Check if $user can update Chemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Chemical $chemical
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Chemical $chemical)
    {
        return true;
    }

    /**
     * Check if $user can delete Chemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Chemical $chemical
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Chemical $chemical)
    {
        return true;
    }

    /**
     * Check if $user can view Chemical
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Chemical $chemical
     * @return bool
     */
    public function canView(IdentityInterface $user, Chemical $chemical)
    {
        return true;
    }
}
