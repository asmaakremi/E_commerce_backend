<?php

namespace App\Http\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUserByEmail($email);
    public function deleteUser($id);
    public function createUser(array $userDetails);
    public function updateUser($id, array $newDetails);
    // public function getFulfilledOrders();
}
