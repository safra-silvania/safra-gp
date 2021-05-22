<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\State;
use Authorization\IdentityInterface;

/**
 * State policy
 */
class StatePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, State $state)
    {
        return $this->isDeveloper($user);
    }
    
    /**
     * Check if $user can create State
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\State $state
     * @return bool
     */
    public function canCreate(IdentityInterface $user, State $state)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can update State
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\State $state
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, State $state)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can delete State
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\State $state
     * @return bool
     */
    public function canDelete(IdentityInterface $user, State $state)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can view State
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\State $state
     * @return bool
     */
    public function canView(IdentityInterface $user, State $state)
    {
        return $this->isDeveloper($user);
    }
}
