<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
   public function index(){
    // echo '123';
    $categories = DB::table('categories')->get();
    // $categories = Category::all();
    dd($categories);
    return view('admin.category.index', compact('categories'));
   }
   public function delete(){
    
    return view('admin.category.index', compact('categories'));
   }
}
