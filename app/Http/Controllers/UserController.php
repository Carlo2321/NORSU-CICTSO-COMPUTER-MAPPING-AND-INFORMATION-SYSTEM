<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'userName' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
        ]);

        if (isset($validatedData['userName'])) {
            $user->userName = $validatedData['userName'];
        }
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return response()->json(['message' => 'User information updated successfully.']);
    }
    
    public function getUser(Request $request)
    {
        return response()->json(Auth::user());
    }
}
