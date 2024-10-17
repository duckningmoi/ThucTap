<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AddsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adss = DB::table('adss')->get();
        return view('admin.adss.index', compact('adss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adss.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->except('_token');
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('uploads/adss', 'public');
        } else {
            $validatedData['image'] = null;
        }
        DB::table('adss')->insertGetId($validatedData);
        return redirect()->route('admin.adss.index')->with('success', 'Thêm bài viết thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adss = DB::table('adss')->where('_id', $id)->first();
        return view('admin.adss.edit', compact('adss'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $adss = DB::table('adss')->where('_id', $id)->first();
        $validatedData = $request->except('_token', '_method');
        if ($request->hasFile('image')) {
            if ($adss['image'] && Storage::disk('public')->exists($adss['image'])) {
                Storage::disk('public')->delete($adss['image']);
            }
            $validatedData['image'] = $request->file('image')->store('uploads/adss', 'public');
        } else {
            $validatedData['image'] = $adss['image'];
        }
        DB::table('adss')->where('_id', $id)->update([
            'image' => $validatedData['image'],
            'link_url' => $validatedData['link_url'],
            'vitri' => $validatedData['vitri'],
            'active' => $validatedData['active'],
        ]);
        return redirect()->route('admin.adss.index')->with('success', 'Thêm bài viết thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adss = DB::table('adss')->where('_id', $id)->first();
    if ($adss) {
        if ($adss['image'] && Storage::disk('public')->exists($adss['image'])) {
            Storage::disk('public')->delete($adss['image']);
        }
        DB::table('adss')->where('_id', $id)->delete();
        return redirect()->route('admin.adss.index')->with('success', 'Quảng cáo đã được xóa thành công!');
    }
    return redirect()->route('admin.adss.index')->with('error', 'Quảng cáo không tồn tại!');
    }
}
