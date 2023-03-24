<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'account' => 'Incorrect username or password',
            ]);
        }

        return $user->createToken('user login')->plainTextToken;

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully!'
        ]);
    }

    public function accountDetail(Request $request){
        $user = Auth::user();
        return response()->json($user);
    }

}
