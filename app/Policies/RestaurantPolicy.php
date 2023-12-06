<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;

class RestaurantPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->restaurant === null;
    }

    public function update(User $user, Restaurant $restaurant): bool
    {
        return ($user->hasRole('seller') && $user->restaurant->is($restaurant)) || ($user->hasRole('admin')) ;
    }

    public function delete(User $user, Restaurant $restaurant): bool
    {
        return ($user->hasRole('seller') && $user->restaurant->is($restaurant)) || ($user->hasRole('admin')) ;
    }

    public function view(User $user, Restaurant $restaurant): bool
    {
//        return ($user->hasRole('seller') && $user->restaurant->is($restaurant)) || ($user->hasRole('admin')) ;
        return $user->hasRole('admin') ;
    }


}
