<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DeclaracionJurada;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeclaracionJuradaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DeclaracionJurada');
    }

    public function view(AuthUser $authUser, DeclaracionJurada $declaracionJurada): bool
    {
        return $authUser->can('View:DeclaracionJurada');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DeclaracionJurada');
    }

    public function update(AuthUser $authUser, DeclaracionJurada $declaracionJurada): bool
    {
        return $authUser->can('Update:DeclaracionJurada');
    }

    public function delete(AuthUser $authUser, DeclaracionJurada $declaracionJurada): bool
    {
        return $authUser->can('Delete:DeclaracionJurada');
    }

    public function restore(AuthUser $authUser, DeclaracionJurada $declaracionJurada): bool
    {
        return $authUser->can('Restore:DeclaracionJurada');
    }

    public function forceDelete(AuthUser $authUser, DeclaracionJurada $declaracionJurada): bool
    {
        return $authUser->can('ForceDelete:DeclaracionJurada');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DeclaracionJurada');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DeclaracionJurada');
    }

    public function replicate(AuthUser $authUser, DeclaracionJurada $declaracionJurada): bool
    {
        return $authUser->can('Replicate:DeclaracionJurada');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DeclaracionJurada');
    }

}