<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SuppliersSupplierType;
use Authorization\IdentityInterface;

/**
 * SuppliersSupplierType policy
 */
class SuppliersSupplierTypePolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, SuppliersSupplierType $suppliersSupplierType)
    {
        return false;
    }
    
    /**
     * Check if $user can create SuppliersSupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SuppliersSupplierType $suppliersSupplierType
     * @return bool
     */
    public function canCreate(IdentityInterface $user, SuppliersSupplierType $suppliersSupplierType)
    {
        return false;
    }

    /**
     * Check if $user can update SuppliersSupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SuppliersSupplierType $suppliersSupplierType
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, SuppliersSupplierType $suppliersSupplierType)
    {
        return false;
    }

    /**
     * Check if $user can delete SuppliersSupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SuppliersSupplierType $suppliersSupplierType
     * @return bool
     */
    public function canDelete(IdentityInterface $user, SuppliersSupplierType $suppliersSupplierType)
    {
        return false;
    }

    /**
     * Check if $user can view SuppliersSupplierType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SuppliersSupplierType $suppliersSupplierType
     * @return bool
     */
    public function canView(IdentityInterface $user, SuppliersSupplierType $suppliersSupplierType)
    {
        return false;
    }
}
