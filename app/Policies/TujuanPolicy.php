<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Tujuan;
use Illuminate\Auth\Access\HandlesAuthorization;

class TujuanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Tujuan');
    }

    public function view(AuthUser $authUser, Tujuan $tujuan): bool
    {
        return $authUser->can('View:Tujuan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Tujuan');
    }

    public function update(AuthUser $authUser, Tujuan $tujuan): bool
    {
        return $authUser->can('Update:Tujuan');
    }

    public function delete(AuthUser $authUser, Tujuan $tujuan): bool
    {
        return $authUser->can('Delete:Tujuan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Tujuan');
    }

    public function restore(AuthUser $authUser, Tujuan $tujuan): bool
    {
        return $authUser->can('Restore:Tujuan');
    }

    public function forceDelete(AuthUser $authUser, Tujuan $tujuan): bool
    {
        return $authUser->can('ForceDelete:Tujuan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Tujuan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Tujuan');
    }

    public function replicate(AuthUser $authUser, Tujuan $tujuan): bool
    {
        return $authUser->can('Replicate:Tujuan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Tujuan');
    }

}