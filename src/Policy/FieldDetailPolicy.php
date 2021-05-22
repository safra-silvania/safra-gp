<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\FieldDetail;
use Authorization\IdentityInterface;

/**
 * FieldDetail policy
 */
class FieldDetailPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, FieldDetail $fieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can create FieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FieldDetail $fieldDetail
     * @return bool
     */
    public function canCreate(IdentityInterface $user, FieldDetail $fieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can update FieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FieldDetail $fieldDetail
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, FieldDetail $fieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can delete FieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FieldDetail $fieldDetail
     * @return bool
     */
    public function canDelete(IdentityInterface $user, FieldDetail $fieldDetail)
    {
        return true;
    }

    /**
     * Check if $user can view FieldDetail
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\FieldDetail $fieldDetail
     * @return bool
     */
    public function canView(IdentityInterface $user, FieldDetail $fieldDetail)
    {
        return true;
    }
}
