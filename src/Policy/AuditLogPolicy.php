<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\AuditLog;
use Authorization\IdentityInterface;

/**
 * AuditLog policy
 */
class AuditLogPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, AuditLog $auditLog)
    {
        return false;
    }

    /**
     * Check if $user can create AuditLog
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\AuditLog $auditLog
     * @return bool
     */
    public function canCreate(IdentityInterface $user, AuditLog $auditLog)
    {
        return true;
    }

    /**
     * Check if $user can update AuditLog
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\AuditLog $auditLog
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, AuditLog $auditLog)
    {
        return true;
    }

    /**
     * Check if $user can delete AuditLog
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\AuditLog $auditLog
     * @return bool
     */
    public function canDelete(IdentityInterface $user, AuditLog $auditLog)
    {
        return true;
    }

    /**
     * Check if $user can view AuditLog
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\AuditLog $auditLog
     * @return bool
     */
    public function canView(IdentityInterface $user, AuditLog $auditLog)
    {
        return true;
    }
}
