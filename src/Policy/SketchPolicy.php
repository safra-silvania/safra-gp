<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\sketch;
use Authorization\IdentityInterface;

/**
 * sketch policy
 */
class sketchPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, sketch $sketch)
    {
        return true;
    }

    /**
     * Check if $user can create sketch
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\sketch $sketch
     * @return bool
     */
    public function canCreate(IdentityInterface $user, sketch $sketch)
    {
        return true;
    }

    /**
     * Check if $user can update sketch
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\sketch $sketch
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, sketch $sketch)
    {
        return true;
    }

    /**
     * Check if $user can delete sketch
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\sketch $sketch
     * @return bool
     */
    public function canDelete(IdentityInterface $user, sketch $sketch)
    {
        return true;
    }

    /**
     * Check if $user can view sketch
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\sketch $sketch
     * @return bool
     */
    public function canView(IdentityInterface $user, sketch $sketch)
    {
        return true;
    }
}
