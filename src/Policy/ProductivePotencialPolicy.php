<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ProductivePotencial;
use Authorization\IdentityInterface;

/**
 * ProductivePotencial policy
 */
class ProductivePotencialPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, ProductivePotencial $productivePotencial)
    {
        return true;
    }
    
    /**
     * Check if $user can create ProductivePotencial
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ProductivePotencial $productivePotencial
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ProductivePotencial $productivePotencial)
    {
        return true;
    }

    /**
     * Check if $user can update ProductivePotencial
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ProductivePotencial $productivePotencial
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ProductivePotencial $productivePotencial)
    {
        return true;
    }

    /**
     * Check if $user can delete ProductivePotencial
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ProductivePotencial $productivePotencial
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ProductivePotencial $productivePotencial)
    {
        return true;
    }

    /**
     * Check if $user can view ProductivePotencial
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\ProductivePotencial $productivePotencial
     * @return bool
     */
    public function canView(IdentityInterface $user, ProductivePotencial $productivePotencial)
    {
        return true;
    }
}
