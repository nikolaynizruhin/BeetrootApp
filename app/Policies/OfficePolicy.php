<?php

namespace App\Policies;

use App\User;
use App\Office;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create offices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view edit office page.
     *
     * @param  \App\User  $user
     * @param  \App\Office  $office
     * @return mixed
     */
    public function edit(User $user, Office $office)
    {
        return false;
    }

    /**
     * Determine whether the user can update the office.
     *
     * @param  \App\User  $user
     * @param  \App\Office  $office
     * @return mixed
     */
    public function update(User $user, Office $office)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the office.
     *
     * @param  \App\User  $user
     * @param  \App\Office  $office
     * @return mixed
     */
    public function delete(User $user, Office $office)
    {
        return false;
    }
}
