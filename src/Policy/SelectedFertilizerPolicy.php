<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\SelectedFertilizer;
use Authorization\IdentityInterface;

/**
 * SelectedFertilizer policy
 */
class SelectedFertilizerPolicy extends Base\BasePolicy
{
    public function canAccess(IdentityInterface $user, SelectedFertilizer $selectedFertilizer)
    {
        return $this->isDeveloper($user);
    }

    /**
     * Check if $user can create SelectedFertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedFertilizer $selectedFertilizer
     * @return bool
     */
    public function canCreate(IdentityInterface $user, SelectedFertilizer $selectedFertilizer)
    {
        return true;
    }

    /**
     * Check if $user can update SelectedFertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedFertilizer $selectedFertilizer
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, SelectedFertilizer $selectedFertilizer)
    {
        return true;
    }

    /**
     * Check if $user can delete SelectedFertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedFertilizer $selectedFertilizer
     * @return bool
     */
    public function canDelete(IdentityInterface $user, SelectedFertilizer $selectedFertilizer)
    {
        return true;
    }

    /**
     * Check if $user can view SelectedFertilizer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\SelectedFertilizer $selectedFertilizer
     * @return bool
     */
    public function canView(IdentityInterface $user, SelectedFertilizer $selectedFertilizer)
    {
        return true;
    }
}
