<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('user')->get();
        return view('admin.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $email = DB::table('user')->where('email', $request->email)->exists();
        if($email){
            return redirect()->back()->with('error', 'Email đã tồn tại');
        }

        if($request->password === $request->password_confirmation){
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];
            DB::table('user')->insert($data);
            return redirect()->route('admin.user.index')->with('success', 'Thêm mới thành công');
        }
        else{
            return redirect()->back()->with('error', 'Password và Confirm Password không trùng nhau');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = DB::table('user')->where('_id', $id)->first();
        return view('admin.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];
            DB::table('user')
            ->where('_id', $id)
            ->update($data);
            return redirect()->route('admin.user.index')->with('success', 'Sửa mới thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('user')
        ->where('_id', $id)
        ->delete();
        return redirect()->route('admin.user.index')->with('success', 'Xóa thành công');
    }
}
