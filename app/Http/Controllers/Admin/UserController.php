<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed', // Validate password with confirmation
            'phone' => 'nullable|string|max:10',
            'role' => 'required|in:admin,user',
        ]);

        // Create new user (data already validated)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Lưu mật khẩu không mã hóa
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        // Redirect back to user list with success message
        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:10',
            'role' => 'required|in:admin,user',
        ]);
    
        // Only update fields that are provided
        $data = $request->only(['name', 'email', 'phone', 'role']);
        
        if ($request->filled('password')) {
            // If password is provided, use the raw password value
            $data['password'] = $request->password;
        }
    
        // Update the user with validated data
        $user->update($data);
    
        // Redirect back to user list with success message "Sửa tài khoản thành công."
        return redirect()->route('admin.users.index')->with('success', 'Sửa tài khoản thành công.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Ensure the user exists and delete
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
