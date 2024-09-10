<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DB::table('posts')->get();
        $categories = DB::table('categories')->pluck('name', '_id')->toArray();
        return view('admin.post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        // var_dump($categories);
        // exit();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // exit();
        if ($request->isMethod('POST')) {
            $validatedData = $request->except('_token');
            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('uploads/post', 'public');
            } else {
                $validatedData['image'] = null;
            }
            $latestId = DB::table('posts')->max('_id');
            $slug = Str::slug($latestId);
            $validatedData['slug'] = $slug;
            // tạm thời fix cứng là 1;
            $validatedData['user_id'] = 1;
            $postId = DB::table('posts')->insertGetId($validatedData);
            if ($request->hasFile('images')) {
                $tieude = $request->input('tieude');
                foreach ($request->file('images') as $index => $image) {
                    if ($image) {
                        $path = $image->store('uploads/images/id_' . $postId, 'public');
                        DB::table('post_images')->insert([
                            'post_id' => $postId,
                            'image' => $path,
                            'tieude' => $tieude[$index] ?? null
                        ]);
                    }
                }
            }

            return redirect()->route('admin.post.index')->with('success', 'Thêm bài viết thành công.');
        }
        //         echo '<pre>';
// print_r($request->all());
// echo '</pre>';
// exit();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $categories = DB::table('categories')->get();
        $post = DB::table('posts')->where('slug', $slug)->first();
        $potsId = $post['_id'];
        $images = DB::table('post_images')->where('post_id', $potsId)->get();

        return view('admin.post.edit', compact('post', 'categories', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {

        $post = DB::table('posts')->where('slug', $slug)->first();
        $postId=$post['_id'];
        // $imagePost = DB::table('post_images')->where('post_id', $postId)->get();
                    

        if (!$post) {
            return redirect()->back()->withErrors(['error' => 'Không có trang.']);
        }
        $post = (array) $post;
        if ($request->isMethod('put')) {
            $validatedData = $request->except('_token', '_method');
            if ($request->hasFile('image')) {
                if ($post['image'] && Storage::disk('public')->exists($post['image'])) {
                    Storage::disk('public')->delete($post['image']);
                }
                $validatedData['image'] = $request->file('image')->store('uploads/post', 'public');
            } else {
                $validatedData['image'] = $post['image'];
            }

            DB::table('posts')->where('slug', $slug)->update([
                'name' => $validatedData['name'],
                'location' => $validatedData['location'],
                'is_approved' => $validatedData['is_approved'],
                'category_id' => $validatedData['category_id'],
                'content' => $validatedData['content'],
                'image' => $validatedData['image'],
                'user_id' => $post['user_id'],
                'slug' => $post['slug'],
            ]);
            if ($request->hasFile('images')) {
                $tieude = $request->input('tieude');
                $oldImages = DB::table('post_images')->where('post_id', $post['_id'])->pluck('image');
                DB::table('post_images')->where('post_id', $post['_id'])->delete();
                foreach ($oldImages as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $directoryPath = 'uploads/images/id_' . $post['_id'];
                if (!Storage::disk('public')->allFiles($directoryPath)) {
                    Storage::disk('public')->deleteDirectory($directoryPath);
                }
                foreach ($request->file('images') as $index => $image) {
                    if ($image instanceof \Illuminate\Http\UploadedFile) {
                        $path = $image->store($directoryPath, 'public');
                        DB::table('post_images')->insert([
                            'post_id' => $post['_id'],
                            'image' => $path,
                            'tieude' => $tieude[$index] ?? null
                        ]);
                    }
                }
            }
            return redirect()->route('admin.post.index')->with('success', 'Sửa thành công');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        // Tìm bài viết theo slug
    $post = DB::table('posts')->where('slug', $slug)->first();
    
    if (!$post) {
        return redirect()->route('admin.post.index')->with('error', 'Không có trang');
    }
    
    $images = DB::table('post_images')->where('post_id', $post['_id'])->pluck('image');
    
    // Xóa tất cả các bản ghi ảnh trong cơ sở dữ liệu
    DB::table('post_images')->where('post_id', $post['_id'])->delete();
    
    // Xóa tất cả các ảnh khỏi hệ thống tập tin
    foreach ($images as $imagePath) {
        Storage::disk('public')->delete($imagePath);
    }
    
    // Xóa thư mục nếu nó rỗng
    $directoryPath = 'uploads/images/id_' . $post['_id'];
    if (Storage::disk('public')->exists($directoryPath) && !Storage::disk('public')->allFiles($directoryPath)) {
        Storage::disk('public')->deleteDirectory($directoryPath);
    }
    
    // Xóa bài viết khỏi cơ sở dữ liệu
    DB::table('posts')->where('slug', $slug)->delete();
    
    return redirect()->route('admin.post.index')->with('success', 'Xóa thành công');
    }
    
}
