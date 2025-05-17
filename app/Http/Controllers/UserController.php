<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\http\Response;
use Illuminate\support\facades\hash;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index()
    {
        $users = users::all();
        return $users;
    }

    public function register(Request $request)
    {
        $users = users::create([
            'username' => $request->username,
            'email' => $request->email,
            'password_hash' => $request->password_hash,
            'profile_image_url' => $request->profile_image_url,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $users]);
    }

    public function show($id)
    {
        $users = users::find($id);
        return $users;
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password_hash' => 'required|string|min:8',
        ]);

        $users = $this->getUserByEmail($request->input('email'));

        if (!$users || $request->input('password_hash') !== $users->password_hash) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }
        // لو وصلت هنا يبقى تسجيل الدخول ناجح
        return response()->json([
            'message' => 'Login successful',
            'user' => $users,
        ]);
    }
    private function getUserByEmail($email){
        return users::where('email', $email)->first();
    }

    public function edit(Request $request, $id){
        $users = users::findorFail($id);
        $users->username = $request->username;
        $users->password_hash = $request->password_hash;
        $users->email = $request->email;
        $users->profile_image_url = $request->profile_image_url;
        return response()->json(['message' => 'User Edited successfully', 'user' => $users]);
    }


}

