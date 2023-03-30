<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\UserServices\AuthentificationService;


use Laravel\Passport\Token;

class AuthentificationController extends Controller
{
    protected AuthentificationService $authService;

    public function __construct(AuthentificationService $auth)
    {
        $this->authService = $auth;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = $this->authService->checkLogin($request->email, $request->password);


            //create an access token manually to authenticate user using passport
            return response([
                'success' => true,
                'message' => 'user named ' . $user->name . ' logged in',
                'logged_user_data' => $user,
                'token' => $user->createToken('Authorization')->accessToken

            ], 200);
        } catch (\Exception $exception) {
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }



    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:users',
            'photo' => 'image|mimes:jpg,bmp,png',
        ]);



        // Save the file locally in the storage/public/ folder under a new folder named /product

        try {
            $this->authService->storeNewUser(
                [
                    'username' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'photo' => $request->photo->hashName(),
                ],
                $request->photo

            );

            return response([
                'success' => true,
                'message' => 'user named ' . $request->name . ' created successfully',
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response([
            'success' => 'true',
            'message' => 'logout'
        ], 200);
    }
}
