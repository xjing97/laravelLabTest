<?php

namespace App\Policies;

use App\User;
use App\Movie;
//use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
//    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(User $user)
    {
        if($user->type == "superAdmin"||$user->type == "admin"){
          return true;
        }
        else{
          return false;
        }
    }

    public function updateAndDelete(User $user,Movie $movie)
    {
        if($user->type == "superAdmin" || ($user->type == "admin" && $user->id == $movie->user_id)){
          return true;
        }
        else{
          return false;
        }
    }

}
