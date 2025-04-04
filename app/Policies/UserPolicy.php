<?php

namespace App\Policies;

use App\Models\MituAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function viewAny(MituAccount $user): bool
    {
        return $user->can('view_any_user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function view(MituAccount $user): bool
    {
        return $user->can('view_user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function create(MituAccount $user): bool
    {
        return $user->can('create_user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function update(MituAccount $user): bool
    {
        return $user->can('update_user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function delete(MituAccount $user): bool
    {
        return $user->can('delete_user');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function deleteAny(MituAccount $user): bool
    {
        return $user->can('delete_any_user');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function forceDelete(MituAccount $user): bool
    {
        return $user->can('force_delete_user');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function forceDeleteAny(MituAccount $user): bool
    {
        return $user->can('force_delete_any_user');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function restore(MituAccount $user): bool
    {
        return $user->can('restore_user');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function restoreAny(MituAccount $user): bool
    {
        return $user->can('restore_any_user');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function replicate(MituAccount $user): bool
    {
        return $user->can('replicate_user');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\MituAccount  $user
     * @return bool
     */
    public function reorder(MituAccount $user): bool
    {
        return $user->can('reorder_user');
    }
}
