<?php 

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     *  Get all users.
     *  Returns a collection of users.
     */
    public static function all()
    {
        $users = User::all();

        return $users;
    }

    /**
     *  Store a new user.
     *  Returns the newly stored object.
     */
    public static function store($validated)
    {
        $user = User::create($validated);

        return $user;
    }
}