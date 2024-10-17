<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
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

    public function PostCate(Request $request, string $slug)
    {
        $category = DB::table('categories')->where('slug', $slug)->first();
        $posts = DB::table('posts')
            ->where('category_id', $category->id)
            ->get();
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
        $query = DB::table('posts');
        $category = DB::table('categories');
        if ($request->filled('keyword')) {
           $cate = $category->where('name', 'LIKE', '%' . $request->keyword . '%')->select('_id')->first();
           $oid = (string)$cate['_id']; 
                $query->orWhere('name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('location', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('category_id',$oid);
                    $results = $query->get();
            return response()->json($results);
        }



    }
}
