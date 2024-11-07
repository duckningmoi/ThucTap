<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ApiAuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = DB::collection('user')->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user['password'])) {
            throw ValidationException::withMessages([
                'email' => ['Thông tin đăng nhập không chính xác'],
            ]);
        }
        
        // Tạo token cho người dùng
        $token = $this->createTokenForUser($user); // Hàm tự tạo cho việc tạo token
        DB::collection('personal_access_tokens')->insert([
            'token' => $token,
            'tokenable_id' => $user['_id'],
        ]);
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Đăng nhập thành công',
        ]);
    }

    public function logout(Request $request)
    {
        $user = DB::collection('user')->where('_id', $request->_id)->first();
    
       
        if ($user) {
            // Xóa tokens từ collection personal_access_tokens
            $deletedCount = DB::collection('personal_access_tokens')->where('tokenable_id', $user['_id'])->delete();
    
            return response()->json([
                'message' => 'Đăng xuất thành công',
                'user' => $user,
                'deleted_count' => $deletedCount,
            ]);
        }
    
        return response()->json([
            'message' => 'Người dùng không tìm thấy',
        ], 404);
    }

    public function register(Request $request)
    {

        $passwordHash = Hash::make($request->password);
        
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $passwordHash,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $userId = DB::collection('user')->insertGetId($userData);

        // Lấy thông tin người dùng
        $user = DB::collection('user')->where('_id', $userId)->first();

        // Tạo token cho người dùng
        $token = $this->createTokenForUser($user); 

        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Đăng ký thành công',
        ]);
    }

    private function createTokenForUser($user)
    {
      
        return 'dummy-token-for-' . $user['_id']  . Str::random(5); 
    }
}