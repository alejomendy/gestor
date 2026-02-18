<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->id === 1 || $user->hasRole(['admin', 'jefe', 'empleado']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $worker): bool
    {
        return $user->id === 1 || $user->hasRole(['admin', 'jefe', 'empleado']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'jefe']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $worker): bool
    {
        return $user->hasRole(['admin', 'jefe']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $worker): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, $worker): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, $worker): bool
    {
        return $user->hasRole('admin');
    }
}
