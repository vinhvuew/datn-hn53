<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:10',
            'role' => 'required|in:admin,user',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);
        return redirect()->route('admin.users.index')->with('Thành Công','Tạo Tài Khoản Thành Công.');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $user = User::findOrFail($id);

       $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users,email,' . $id,
        'password'=>'required|min:6',
        'phone'=>'nullable|string|max:10',
        'role'=>'required|in:admin,user',
       ]);
       $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'phone'=>$request->phone,
        'role'=>$request->role,
       ]);
       return redirect()->route('admin.users.index')->with('Thành Công','Cập Nhật Thành Công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('Thành Công',' Xóa Tài Khoản Thành Công');
    }
}
