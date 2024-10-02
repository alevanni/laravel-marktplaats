<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BidPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bid $bid): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ad $ad): bool
    {
        //dd($ad);
        return $user->id === $ad->user_id;
        // return $user->id === $ad->user_id
        //     ? Response::denyWithStatus(403)
        //     : Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bid $bid): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bid $bid): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bid $bid): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bid $bid): bool
    {
        return false;
    }
}
