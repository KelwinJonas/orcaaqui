<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Checa se o usuário logado é um comprador.
     *
     * @return bool
     */
    public function isComprador(User $user)
    {
        return $user->role == User::ROLE_ENUM['comprador'];
    }

    /**
     * Checa se o usuário logado é um fornecedor.
     *
     * @return bool
     */
    public function isFornecedor(User $user)
    {
        return $user->role == User::ROLE_ENUM['fornecedor'];
    }
}
