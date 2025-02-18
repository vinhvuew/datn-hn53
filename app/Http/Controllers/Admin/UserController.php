<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.users.';

    public function index()
    {
        $users = User::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Tạo tài khoản thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
 


public function update(Request $request, $id)
{
    
    $user = User::findOrFail($id);

   
    $validatedData = $request->validate([
        'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
        'phone' => 'nullable|numeric|unique:users,phone,' . $user->id, 
        'role' => 'required|in:admin,user', 
        'password' => 'nullable|string|min:6|confirmed', 
    ]);

    
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->name = $request->name;
    $user->email = $validatedData['email'];
    $user->phone = $validatedData['phone'];
    $user->role = $validatedData['role'];

   
    $user->save();

   
    return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
