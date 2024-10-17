<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class ApiAuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Thông tin đăng nhập không chính xác'],
            ]);
        }
        $token = $user->createToken('Access Token')->plainTextToken;
        // dd($token);
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'dang nhập thanh cong',
        ]);
    }
    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'dang xuat thanh cong',
            'user' => $user,
        ]);
    }

    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('Access Token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Đăng ký thành công',
        ]);
    }
}
