<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Car;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
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
        return $user->hasPermissionTo('Read-Cars')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Car $car)
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
        return $user->hasPermissionTo('Create-Car')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Car $car)
    {
        //
        return $user->hasPermissionTo('Update-Car')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $User
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Car $car)
    {
        //
        return $user->hasPermissionTo('Delete-Car')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Car $car)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $User
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Car $car)
    {
        //
    }
}
