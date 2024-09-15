<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    Public function Trangchu(){
        $post=DB::table('posts')->where('is_approved',1)->get();
        return response()->json([
            'post'=>$post
        ],200);
    }
}
