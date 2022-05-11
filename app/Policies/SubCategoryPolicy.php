<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\subCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        //
        return $user->hasPermissionTo('Read-SubCategories')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, subCategory $subCategory)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        //
        return $user->hasPermissionTo('Create-SubCategory')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, subCategory $subCategory)
    {
        //
        return $user->hasPermissionTo('Update-SubCategory')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, subCategory $subCategory)
    {
        //
        return $user->hasPermissionTo('Delete-SubCategory')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, subCategory $subCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, subCategory $subCategory)
    {
        //
    }
}
