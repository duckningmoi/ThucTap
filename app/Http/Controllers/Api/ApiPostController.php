<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function Trangchu()
    {
        // bài viết
        $post = DB::table('posts')->where('is_approved', "1")->get();
        return response()->json([
            'post' => $post
        ], 200);
    }
// đầu header
    public function category()
    {
        $category = DB::table('categories')->get();
        return response()->json([
            'category' => $category
        ], 200);
    }
    // bài viết theo danh mục 
    public function PostCate(Request $request ,string $slug){
        $category = DB::table('categories')->where('slug', $slug)->first();
        $posts = DB::table('posts')
            ->where('category_id', $category->id)
            ->get();
        return response()->json([
            'category' => $category,
            'posts' => $posts
        ]);
    }
}
