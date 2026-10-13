<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Kantor;
use Illuminate\Auth\Access\HandlesAuthorization;

class KantorPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Kantor');
    }

    public function view(AuthUser $authUser, Kantor $kantor): bool
    {
        return $authUser->can('View:Kantor');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Kantor');
    }

    public function update(AuthUser $authUser, Kantor $kantor): bool
    {
        return $authUser->can('Update:Kantor');
    }

    public function delete(AuthUser $authUser, Kantor $kantor): bool
    {
        return $authUser->can('Delete:Kantor');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Kantor');
    }

    public function restore(AuthUser $authUser, Kantor $kantor): bool
    {
        return $authUser->can('Restore:Kantor');
    }

    public function forceDelete(AuthUser $authUser, Kantor $kantor): bool
    {
        return $authUser->can('ForceDelete:Kantor');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Kantor');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Kantor');
    }

    public function replicate(AuthUser $authUser, Kantor $kantor): bool
    {
        return $authUser->can('Replicate:Kantor');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Kantor');
    }

}