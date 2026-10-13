<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pengalaman;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengalamanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pengalaman');
    }

    public function view(AuthUser $authUser, Pengalaman $pengalaman): bool
    {
        return $authUser->can('View:Pengalaman');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pengalaman');
    }

    public function update(AuthUser $authUser, Pengalaman $pengalaman): bool
    {
        return $authUser->can('Update:Pengalaman');
    }

    public function delete(AuthUser $authUser, Pengalaman $pengalaman): bool
    {
        return $authUser->can('Delete:Pengalaman');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Pengalaman');
    }

    public function restore(AuthUser $authUser, Pengalaman $pengalaman): bool
    {
        return $authUser->can('Restore:Pengalaman');
    }

    public function forceDelete(AuthUser $authUser, Pengalaman $pengalaman): bool
    {
        return $authUser->can('ForceDelete:Pengalaman');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pengalaman');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pengalaman');
    }

    public function replicate(AuthUser $authUser, Pengalaman $pengalaman): bool
    {
        return $authUser->can('Replicate:Pengalaman');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pengalaman');
    }

}