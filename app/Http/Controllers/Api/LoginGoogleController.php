<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Exception;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;


// class LoginGoogleController extends Controller
// {
//     public function redirectToGoogle()
//     {
//         return Socialite::driver('google')
//             ->scopes(['profile', 'email'])
//             ->redirect();
//     }



//     /**

//      * Create a new controller instance.

//      *

//      * @return void

//      */

//     public function handleGoogleCallback()
//     {
//         try {
//             $user = Socialite::driver('google')->user();
//             // Tìm user bằng email
//             $finduser = DB::collection('user')->where('email', $user->email)->first();

//             if ($finduser) {
//                 // Nếu tìm thấy người dùng, có thể cập nhật trường google_id
//                 if (!isset($finduser['google_id'])) {
//                     DB::collection('users')->where('_id', $finduser['_id'])->update([
//                         'google_id' => $user->id
//                     ]);
//                 }

//                 session([
//                     'user_id' => $finduser['_id'],
//                     'name' => $finduser['name'],
//                     'email' => $finduser['email'],
//                 ]);
//                 session()->put('is_logged_in', true); 
//                 return redirect()->intended('admin');
//             } else {
//                 DB::collection('user')->insert([
//                     'name' => $user->name,
//                     'email' => $user->email,
//                     'google_id' => $user->id,
//                     'password' => bcrypt('123456dummy') 
//                 ]);
//                 $newUserId = DB::collection('user')->where('email', $user->email)->first()['_id'];
//                 session([
//                     'user_id' => $newUserId,
//                     'name' => $user->name,
//                     'email' => $user->email,
//                 ]);
//                 session()->put('is_logged_in', true); 

//                 return redirect()->intended('admin');
//             }
//         } catch (Exception $e) {
//             // Bắt ngoại lệ và xử lý
//             dd($e->getMessage());
//         }
//     }

// }


class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['profile', 'email'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        
        try {
            $user = Socialite::driver('google')->user();
            // Tìm user bằng email
            $finduser = DB::collection('user')->where('email', $user->email)->first();

            if ($finduser) {
                // Nếu tìm thấy người dùng, có thể cập nhật trường google_id
                if (!isset($finduser['google_id'])) {
                    DB::collection('user')->where('_id', $finduser['_id'])->update([
                        'google_id' => $user->id
                    ]);
                }
                // Tạo token cho người dùng
                $token = $this->createToken($finduser['_id']); 
                return response()->json([
                    'success' => true,
                    'user' => $finduser,
                    'token' => $token,
                ]);
            } else {
                // Tạo user mới nếu chưa tồn tại
                $newUser = DB::collection('user')->insert([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt('123456dummy') // Sử dụng bcrypt để mã hóa mật khẩu
                ]);
                
                // Lấy ID của người dùng mới
                $newUserId = DB::collection('users')->where('email', $user->email)->first()['_id'];
                
                // Tạo token cho người dùng mới
                $token = $this->createToken($newUserId);
                
                return response()->json([
                    'success' => true,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'token' => $token,
                ]);
            }
        } catch (Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình đăng nhập.',
            ], 500);
        }
    }

    private function createToken($userId)
    {
        
        return bin2hex(random_bytes(40)); 
    }


    public function googleDetail(string $google_id){
        $post = DB::collection('user')->where('google_id', $google_id)->first();
        return response()->json([
            'message' =>'Thành công',
            'post'=>$post,
        ]);
    }
}