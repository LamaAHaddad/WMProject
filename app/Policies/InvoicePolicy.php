<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
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
        return $user->hasPermissionTo('Read-Invoices')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Invoice $invoice)
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
        return $user->hasPermissionTo('Create-Invoice')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Invoice $invoice)
    {
        //
        return $user->hasPermissionTo('Update-Invoice')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Invoice $invoice)
    {
        //
        return $user->hasPermissionTo('Delete-Invoice')
        ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Invoice $invoice)
    {
        //
    }
}
