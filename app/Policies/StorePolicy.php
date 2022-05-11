<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Store;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
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
        return $user->hasPermissionTo('Read-Stores')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Store $store)
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
        return $user->hasPermissionTo('Create-Store')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Store $store)
    {
        //
        return $user->hasPermissionTo('Update-Store')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Store $store)
    {
        //
        return $user->hasPermissionTo('Delete-Store')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Store $store)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Store $store)
    {
        //
    }
}
