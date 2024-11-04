<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $roles = DB::table('roles')->get();
        return view('admin.User.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $email = DB::table('user')->where('email', $request->email)->exists();
            if ($email) {
                return redirect()->back()->with('error', 'Email đã tồn tại');
            }

            if ($request->password === $request->password_confirmation) {
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ];
                $userId = DB::table('user')->insertGetId($data);
                $role = [
                    'user_id' => (string) $userId,
                    'role_id' => $request->role_id,
                ];
                DB::table('user_roles')->updateOrInsert(['user_id' => $userId], $role);
                return redirect()->route('admin.user.index')->with('success', 'Thêm mới thành công');
            } else {
                return redirect()->back()->with('error', 'Password và Confirm Password không trùng nhau');
            }
        } catch (\Exception $e) {
            \Log::error('Error adding new user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
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
        $roles = DB::table('roles')->get();
        $user = DB::table('user')->where('_id', $id)->first();
        $userRole = DB::table('user_roles')->where('user_id', $id)->value('role_id');
        // dd($roles, $user, $userRole);
        return view('admin.User.edit', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        $user = DB::table('user')->where('id', $id)->first();

        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $user['password'];
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ];
        DB::table('user')
            ->where('_id', $id)
            ->update($data);
        $role = [
            'user_id' => (string) $id,
            'role_id' => $request->role_id,
        ];
        DB::table('user_roles')->updateOrInsert(['user_id' => $id], $role);
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
