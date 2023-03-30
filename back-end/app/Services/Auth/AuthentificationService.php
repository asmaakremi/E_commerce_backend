<?php

namespace App\Http\Services\UserServices;

use Exception;
use App\Models\Admin;
use App\Models\Applicant;
use Illuminate\Support\Facades\Hash;
use App\Http\Interfaces\UserRepositoryInterface;

class AuthentificationService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->userRepository = $user;
    }
    public function checkLogin($email, $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user ||  !Hash::check($password, $user->password))
            throw new Exception("email or password is invalid");
        return  $user;
    }
    public function storeNewUser(array $userDetails, $photo)
    {
        $photo->store('images');
        $this->userRepository->createUser($userDetails);
    }
}
