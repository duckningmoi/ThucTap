<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiPostController extends Controller
{
    public function Trangchu()
    {
        // bài viết
        // Lấy ngày hôm nay
        $today = Carbon::today()->toDateString();

        // Truy vấn MongoDB
        $post = DB::table('posts')
            ->where('is_approved', "1")
            ->orderBy('created_at', 'desc')
            ->skip(8)
            ->paginate(5);
        // ->get();

        $postHot = DB::table('posts')
            ->where('is_approved', "1")
            ->orderBy('created_at', 'desc')
            ->first();
        $postHot3 = DB::table('posts')
            ->where('is_approved', "1")
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->limit(3)
            ->get();
        $postHot5 = DB::table('posts')
            ->where('is_approved', "1")
            ->orderBy('created_at', 'desc')
            ->skip(4)
            ->limit(5)
            ->get();
        $adds = DB::table('adss')
            ->where('active', "active")
            ->orderBy('_id', 'desc')
            ->limit(2)
            ->get();
        $addsRight = DB::table('adss')
            ->where('active', "active")
            ->orderBy('_id', 'desc')
            ->skip(4) // Bỏ qua 4 quảng cáo đầu tiên (2 nhóm trước)
            ->limit(2) // Lấy 2 quảng cáo tiếp theo
            ->get();

        $addsLeft = DB::table('adss')
            ->where('active', "active")
            ->orderBy('_id', 'desc')
            ->skip(2) // Bỏ qua 2 quảng cáo đầu tiên
            ->limit(2) // Lấy 2 quảng cáo tiếp theo
            ->get();
        return response()->json([
            'postHot' => $postHot,
            'postHot3' => $postHot3,
            'postHot5' => $postHot5,
            'post' => $post,
            'adds' => $adds,
            'addsLeft' => $addsLeft,
            'addsRight' => $addsRight,
        ], 200);
    }

    public function category()
    {
        $category = DB::table('categories')->get();
        return response()->json([
            'category' => $category
        ], 200);
    }
    // bài viết theo danh mục 
    public function logout(Request $request)
{
    try {
        $user_id = $request->user_id;
        if ($user_id) {
            $user = DB::connection('mongodb')->collection('user')->where('_id', $user_id)->first();
            if ($user) {
                $deletedCount = DB::connection('mongodb')->collection('personal_access_tokens')
                    ->where('tokenable_id', $user_id)
                    ->delete();
                Log::info("Deleted token count: " . $deletedCount);
                return response()->json([
                    'message' => 'Đăng xuất thành công',
                    'deleted_count' => $deletedCount,
                ]);
            }
            return response()->json(['message' => 'Người dùng không tìm thấy'], 404);
        }
        Log::error('Thiếu user_id trong yêu cầu.');
        return response()->json(['message' => 'Yêu cầu không hợp lệ'], 400);
    } catch (\Exception $e) {
        Log::error('Lỗi khi đăng xuất: ' . $e->getMessage());
        return response()->json(['message' => 'Lỗi server'], 500);
    }
}


    public function filterPost($id_category)
    {

        $post = DB::collection('posts')
            ->where('category_id', $id_category)
            ->get();
        $today = Carbon::today()->toDateString();
        $post = DB::collection('posts')->where('category_id', $id_category)
            // ->whereDate('created_at', $today)
            ->get();
        if ($post->isEmpty()) {
            return response()->json([
                'message' => 'Không có bản ghi nào'
            ], 404);
        }

        return response()->json([
            'post' => $post
        ], 200);
    }

    public function searchPosts(Request $request)
    {
        $oid = '';
        $query = DB::table('posts');
        $category = DB::table('categories');
        if ($request->filled('keyword')) {
            $cate = $category->where('name', 'LIKE', '%' . $request->keyword . '%')->select('_id')->first();
            if ($cate) {
                $oid = (string)$cate['_id'];
            }
            $query->orWhere('name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('location', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('category_id', $oid);
            $results = $query->get();
            return response()->json($results);
        }
    }

    public function PostComment(Request $request, string $slug)
    {
        // $user_id = Auth::id();
        $posts = DB::collection('posts')->where('slug', $slug)->first();
        if (!$posts) {
            return response()->json(['message' => 'Bài viết không tìm thấy'], 404);
        }

        $post_id = (string) $posts['_id'];
        $context = $request->input('content');
        $user_id = $request->input('user_id');
        if ($user_id) {
            $PostComment = [
                'post_id' => $post_id,
                'user_id' => $request->input('user_id'),
                'content' => $context,
                'created_at' => Carbon::now()->format('Y-m-d'),
            ];
            $commentId = DB::collection('comments')->insertGetId($PostComment);

            return response()->json([
                'message' => 'Comment thành công',
                'comment_id' => $commentId,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Comment không thành công',

            ], 403);
        }


    }
}