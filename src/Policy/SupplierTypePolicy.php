<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SupplierType;
use Authorization\IdentityInterface;

/**
 * SupplierType policy
 */
class SupplierTypePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, SupplierType $supplierType)
    {
        return false;
    }

    /**
     * Check if $user can create SupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SupplierType $supplierType
     * @return bool
     */
    public function canCreate(IdentityInterface $user, SupplierType $supplierType)
    {
        return false;
    }

    /**
     * Check if $user can update SupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SupplierType $supplierType
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, SupplierType $supplierType)
    {
        return false;
    }

    /**
     * Check if $user can delete SupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SupplierType $supplierType
     * @return bool
     */
    public function canDelete(IdentityInterface $user, SupplierType $supplierType)
    {
        return false;
    }

    /**
     * Check if $user can view SupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SupplierType $supplierType
     * @return bool
     */
    public function canView(IdentityInterface $user, SupplierType $supplierType)
    {
        return false;
    }
}
