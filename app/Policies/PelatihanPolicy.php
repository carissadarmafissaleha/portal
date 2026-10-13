<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pelatihan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelatihanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pelatihan');
    }

    public function view(AuthUser $authUser, Pelatihan $pelatihan): bool
    {
        return $authUser->can('View:Pelatihan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pelatihan');
    }

    public function update(AuthUser $authUser, Pelatihan $pelatihan): bool
    {
        return $authUser->can('Update:Pelatihan');
    }

    public function delete(AuthUser $authUser, Pelatihan $pelatihan): bool
    {
        return $authUser->can('Delete:Pelatihan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Pelatihan');
    }

    public function restore(AuthUser $authUser, Pelatihan $pelatihan): bool
    {
        return $authUser->can('Restore:Pelatihan');
    }

    public function forceDelete(AuthUser $authUser, Pelatihan $pelatihan): bool
    {
        return $authUser->can('ForceDelete:Pelatihan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pelatihan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pelatihan');
    }

    public function replicate(AuthUser $authUser, Pelatihan $pelatihan): bool
    {
        return $authUser->can('Replicate:Pelatihan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pelatihan');
    }

}