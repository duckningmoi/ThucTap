<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->where('created_at', $today)
            ->get();
        return response()->json([
            'post' => $post
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
    public function PostDetail(Request $request, string $slug)
    {
        $post = DB::collection('posts')->where('slug', $slug)->first();
        if (!$post) {
            return response()->json([
                'message' => 'Không có bản ghi nào'
            ], 404);
        }
        DB::collection('posts')->where('slug', $slug)->update(['view' => $post['view'] + 1]);
        return response()->json([
            'post' => $post
        ], 200);
    }

    public function filterPost($id_category)
    {
        // Truy vấn bài viết dựa trên category_id
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
}
