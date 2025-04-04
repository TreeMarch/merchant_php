<?php

namespace App\Policies;

use App\Models\MituAccount; // Thay vì User, sử dụng MituAccount
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\MituAccount $user
     * @return bool
     */
    public function viewAny(MituAccount $user): bool
    {
        return $user->can('view_any_role');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\MituAccount $user
     * @param \Spatie\Permission\Models\Role $role
     * @return bool
     */
    public function view(MituAccount $user, Role $role): bool
    {
        return $user->can('view_role');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\MituAccount $user
     * @return bool
     */
    public function create(MituAccount $user): bool
    {
        return $user->can('create_role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\MituAccount $user
     * @param \Spatie\Permission\Models\Role $role
     * @return bool
     */
    public function update(MituAccount $user, Role $role): bool
    {
        return $user->can('update_role');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\MituAccount $user
     * @param \Spatie\Permission\Models\Role $role
     * @return bool
     */
    public function delete(MituAccount $user, Role $role): bool
    {
        return $user->can('delete_role');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param \App\Models\MituAccount $user
     * @return bool
     */
    public function deleteAny(MituAccount $user): bool
    {
        return $user->can('delete_any_role');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param \App\Models\MituAccount $user
     * @param \Spatie\Permission\Models\Role $role
     * @return bool
     */
    public function forceDelete(MituAccount $user, Role $role): bool
    {
        return $user->can('force_delete_role');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param \App\Models\MituAccount $user
     * @return bool
     */
    public function forceDeleteAny(MituAccount $user): bool
    {
        return $user->can('force_delete_any_role');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param \App\Models\MituAccount $user
     * @param \Spatie\Permission\Models\Role $role
     * @return bool
     */
    public function restore(MituAccount $user, Role $role): bool
    {
        return $user->can('restore_role');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param \App\Models\MituAccount $user
     * @return bool
     */
    public function restoreAny(MituAccount $user): bool
    {
        return $user->can('restore_any_role');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param \App\Models\MituAccount $user
     * @param \Spatie\Permission\Models\Role $role
     * @return bool
     */
    public function replicate(MituAccount $user, Role $role): bool
    {
        return $user->can('replicate_role');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param \App\Models\MituAccount $user
     * @return bool
     */
    public function reorder(MituAccount $user): bool
    {
        return $user->can('reorder_role');
    }
}
