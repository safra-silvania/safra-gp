<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Notification;
use Authorization\IdentityInterface;

/**
 * Notification policy
 */
class NotificationPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Notification $notification)
    {
        return false;
    }
    
    /**
     * Check if $user can create Notification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Notification $notification
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Notification $notification)
    {
        return true;
    }

    /**
     * Check if $user can update Notification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Notification $notification
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Notification $notification)
    {
        return true;
    }

    /**
     * Check if $user can delete Notification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Notification $notification
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Notification $notification)
    {
        return true;
    }

    /**
     * Check if $user can view Notification
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Notification $notification
     * @return bool
     */
    public function canView(IdentityInterface $user, Notification $notification)
    {
        return true;
    }
}
