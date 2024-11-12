<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use MongoDB\BSON\ObjectId;
use MongoDB\Laravel\Eloquent\Casts\ObjectId as CastsObjectId;

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
        // Lấy user_id từ request (có thể từ body hoặc header)
        $user_id = $request->user_id;


        // Kiểm tra nếu user_id tồn tại
        if ($user_id) {
            // Truy vấn người dùng từ collection 'users' trong MongoDB hoặc cơ sở dữ liệu bạn sử dụng
            $user = DB::connection('mongodb')->collection('user')->where('_id', $user_id)->first(); // Hoặc dùng 'user_id' nếu bạn dùng tên khác cho trường ID

            if ($user) {
                // Xóa tokens từ collection 'personal_access_tokens'
                $deletedCount = DB::connection('mongodb')->collection('personal_access_tokens')
                    ->where('tokenable_id',$user_id)
                    ->delete();

                // Log số lượng token đã xóa
                Log::info("Deleted token count: " . $deletedCount);
                return response()->json([
                    'message' => 'Đăng xuất thành công',
                    'user' => $user,
                    'deleted_count' => $deletedCount,
                ]);
            }

            // Trường hợp không tìm thấy người dùng
            return response()->json([
                'message' => 'Người dùng không tìm thấy',
            ], 404);
        } else {
            Log::error('Không tìm thấy người dùng với ID: ' . $user_id);
            return response()->json([
                'message' => 'Người dùng không tìm thấy',
            ], 404);
        }
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

        return 'dummy-token-for-' . $user['_id'] . Str::random(5);
    }
}