<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Producer;
use Authorization\IdentityInterface;

/**
 * Producer policy
 */
class ProducerPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Producer $producer)
    {
        return true;
    }
    
    /**
     * Check if $user can create Producer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Producer $producer
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Producer $producer)
    {
        return true;
    }

    /**
     * Check if $user can update Producer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Producer $producer
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Producer $producer)
    {
        return true;
    }

    /**
     * Check if $user can delete Producer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Producer $producer
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Producer $producer)
    {
        return true;
    }

    /**
     * Check if $user can view Producer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Producer $producer
     * @return bool
     */
    public function canView(IdentityInterface $user, Producer $producer)
    {
        return true;
    }
}
