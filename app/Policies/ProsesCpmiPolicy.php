<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ProsesCpmi;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProsesCpmiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProsesCpmi');
    }

    public function view(AuthUser $authUser, ProsesCpmi $prosesCpmi): bool
    {
        return $authUser->can('View:ProsesCpmi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProsesCpmi');
    }

    public function update(AuthUser $authUser, ProsesCpmi $prosesCpmi): bool
    {
        return $authUser->can('Update:ProsesCpmi');
    }

    public function delete(AuthUser $authUser, ProsesCpmi $prosesCpmi): bool
    {
        return $authUser->can('Delete:ProsesCpmi');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProsesCpmi');
    }

    public function restore(AuthUser $authUser, ProsesCpmi $prosesCpmi): bool
    {
        return $authUser->can('Restore:ProsesCpmi');
    }

    public function forceDelete(AuthUser $authUser, ProsesCpmi $prosesCpmi): bool
    {
        return $authUser->can('ForceDelete:ProsesCpmi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProsesCpmi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProsesCpmi');
    }

    public function replicate(AuthUser $authUser, ProsesCpmi $prosesCpmi): bool
    {
        return $authUser->can('Replicate:ProsesCpmi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProsesCpmi');
    }

}