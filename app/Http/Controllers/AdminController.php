<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = DB::table('posts')->get();
        $statistics = [];
        for ($i = 1; $i <= 12; $i++) {
            $statistics[$i] = 0;
        }

        foreach ($posts as $post) {
            if (isset($post['created_at'])) {
                $created_at = Carbon::parse($post['created_at']);
                $month = $created_at->month; 
                $statistics[$month]++;
            }
        }

        $follows = DB::table('user')
        ->get()
        ->count();

        $views = DB::table('posts')
        ->sum('view');
        return view('admin.index', compact('statistics', 'follows', 'views'));
    }




}
