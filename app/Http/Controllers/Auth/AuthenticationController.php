<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated();
        $user = User::where('nim', $request->nim)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid NIM or Password!'
            ], 401);
        }
        else {
            $token = $user->createToken('authToken')->plainTextToken;
            return response([
                'message' => 'Login success!',
                'user' => $user,
                'token' => $token
            ], 200);
        }
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $userData = [
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ];
        
        $newUser = User::create($userData);
        if(!$newUser) {
            return response([
                'message' => 'Failed to create user!'
            ], 400);
        }
        else{
            $token = $newUser->createToken('authToken')->plainTextToken;
            return response([   
                'message' => 'User created successfully!',
                'user' => $newUser,
                'token' => $token
            ], 201);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Logged out!'
        ], 200);
    }
    
    public function me(Request $request) //login first bro
    {
        return response()->json($request->user());
    }

    public function update(EditProfileRequest $request)
    {
        $request->validated();
        $newData = [
            'name' => $request->name ? $request->name : $request->user()->name,
            'email' => $request->email ? $request->email : $request->user()->email,
            'password' => Hash::make($request->password) ? Hash::make($request->password) : $request->user()->password,
            'role' => $request->role ? $request->role : $request->user()->role,
            'phone_number' => $request->phone_number ? $request->phone_number : $request->user()->phone_number,
        ];
        $user = $request->user();
        $user->update($newData);
        return response([
            'message' => 'Profile updated!',
            'user' => $user
        ], 200);
    }
}
