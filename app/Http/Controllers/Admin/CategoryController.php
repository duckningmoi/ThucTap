<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('admin.Category.table', compact('categories'));
    }
    public function create()
    {
        return view('admin.Category.create');
    }
    public function store(StoreCategoryRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            $latestId = DB::table('categories')->max('_id');
            $name = Str::slug($param['name'], '');
            $slug = $name . $latestId;
            $param['slug'] = $slug;
            DB::table('categories')->insert($param);
            return redirect()->route('admin.category.index')->with('success', 'thêm danh mục thành công');
        }
    }
    public function edit(string $slug)
    {
        $category = DB::table('categories')->where('slug', $slug)->first();
        return view('admin.Category.edit', compact('category'));
    }
    public function update(StoreCategoryRequest $request, $slug)
    {
        //    var_dump($request->all());
        //    exit();
        $category = DB::table('categories')->where('slug', $slug)->first();
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            DB::table('categories')->where('slug', $slug)->update($param);
            return redirect()->route('admin.category.index')->with('success', 'Sửa danh mục thành công');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $category = DB::table('categories')->where('slug', $slug)->first();
        DB::table('categories')->where('slug', $slug)->delete();
        return redirect()->route('admin.category.index')->with('success', 'xóa danh mục thành công');
    }
}
