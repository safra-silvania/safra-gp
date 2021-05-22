<?php
declare(strict_types=1);

namespace App\Policy\Base;

/**
 * Base policy
 */
class BasePolicy
{
    /**
     * Check if $user is Administrador
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    protected function isDeveloper($user): bool
    {
        return $user->id === 1;
    }

    /**
     * Check if $user is Administrador
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    protected function isAdministrador($user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Check if $user is Usuário
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    protected function isUsuario($user): bool
    {
        return $user->role_id === 2;
    }
}
