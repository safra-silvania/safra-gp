<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Supplier;
use Authorization\IdentityInterface;

/**
 * Supplier policy
 */
class SupplierPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Supplier $supplier)
    {
        return true;
    }
    
    /**
     * Check if $user can create Supplier
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Supplier $supplier
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Supplier $supplier)
    {
        return true;
    }

    /**
     * Check if $user can update Supplier
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Supplier $supplier
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Supplier $supplier)
    {
        return true;
    }

    /**
     * Check if $user can delete Supplier
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Supplier $supplier
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Supplier $supplier)
    {
        return true;
    }

    /**
     * Check if $user can view Supplier
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Supplier $supplier
     * @return bool
     */
    public function canView(IdentityInterface $user, Supplier $supplier)
    {
        return true;
    }
}
