<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserRepositoryInterface;
use App\Models\User;


class UserRepository implements UserRepositoryInterface
{


    public function getAllUsers()
    {
        return User::class::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function deleteUser($id)
    {
        User::destroy($id);
    }

    public function createUser(array $userDetails)
    {
        User::create($userDetails);
    }

    public function updateUser($id, array $newDetails)
    {
        return User::whereId($id)->update($newDetails);
    }
}
