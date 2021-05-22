<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Field;
use Authorization\IdentityInterface;

/**
 * Field policy
 */
class FieldPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, Field $field)
    {
        return true;
    }
    
    /**
     * Check if $user can create Field
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Field $field
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Field $field)
    {
        return true;
    }

    /**
     * Check if $user can update Field
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Field $field
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Field $field)
    {
        return true;
    }

    /**
     * Check if $user can delete Field
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Field $field
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Field $field)
    {
        return true;
    }

    /**
     * Check if $user can view Field
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Field $field
     * @return bool
     */
    public function canView(IdentityInterface $user, Field $field)
    {
        return true;
    }
}
