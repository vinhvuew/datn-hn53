<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    const PATH_VIEW = 'admin.roles.';

    const OBJECT = 'roles';

    public function index()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $roles = Role::query()
            ->with('users')
            ->where('name', '!=', 'User') // Loại bỏ role có name là 'User'
            ->get();
        // dd($roles);
        return view('admin.roles.index', compact('roles'));
    }
}
