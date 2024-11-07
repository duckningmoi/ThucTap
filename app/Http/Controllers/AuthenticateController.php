<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function showLogin()
    {
        // $user = User::all();
        // dd($user);

        return view('Admin.login');
    }
    // Đảm bảo đã import model User

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Lấy thông tin người dùng từ MongoDB
        $user = (array) DB::collection('user')->where('email', $request->email)->first();
    
        // Kiểm tra thông tin người dùng và mật khẩu
        if ($user && Hash::check($request->password, $user['password'])) {
            session([
                'user_id' => $user['_id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'is_logged_in' => true,
            ]);
            // dd($user && Hash::check($request->password, $user['password']));
            return redirect()->route('admin.admin');
        // dd($redirect);
        }else{
           
            return redirect()->route('login');

        }
    
    }
    private function createTokenForUser($user)
    {
        return 'dummy-token-for-' . $user['_id'];
    }
}
