<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Tunggu;
use Illuminate\Auth\Access\HandlesAuthorization;

class TungguPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Tunggu');
    }

    public function view(AuthUser $authUser, Tunggu $tunggu): bool
    {
        return $authUser->can('View:Tunggu');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Tunggu');
    }

    public function update(AuthUser $authUser, Tunggu $tunggu): bool
    {
        return $authUser->can('Update:Tunggu');
    }

    public function delete(AuthUser $authUser, Tunggu $tunggu): bool
    {
        return $authUser->can('Delete:Tunggu');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Tunggu');
    }

    public function restore(AuthUser $authUser, Tunggu $tunggu): bool
    {
        return $authUser->can('Restore:Tunggu');
    }

    public function forceDelete(AuthUser $authUser, Tunggu $tunggu): bool
    {
        return $authUser->can('ForceDelete:Tunggu');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Tunggu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Tunggu');
    }

    public function replicate(AuthUser $authUser, Tunggu $tunggu): bool
    {
        return $authUser->can('Replicate:Tunggu');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Tunggu');
    }

}