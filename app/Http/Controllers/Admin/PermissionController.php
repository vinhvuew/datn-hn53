<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    const OBJECT = 'permissions';
    const PATH_VIEW = 'admin.permissions.';


    public function index()
    {
        $data = Permission::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate(
                [
                    'name' => 'required',
                    'slug' => 'required'
                ],
                [
                    'name' => 'Bạn chưa nhập tên quyền!',
                    'slug' => 'Bạn chưa nhập trường này!'
                ]
            );
            Permission::create($data);
            return redirect()->route('permissions.index')->with('success', 'Thêm quyền thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm quyền thất bại!');
        }
    }

    public function edit(String $id)
    {
        $dataID = Permission::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('dataID'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate dữ liệu đầu vào
            $data = $request->validate(
                [
                    'name' => 'required',
                    'slug' => 'required'
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên quyền!',
                    'slug.required' => 'Bạn chưa nhập trường này!'
                ]
            );
            // Tìm quyền theo ID
            $permission = Permission::findOrFail($id);
            // Cập nhật quyền
            $permission->update($data);

            return back()->with('success', 'Cập nhật quyền thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cập nhật quyền thất bại!');
        }
    }

    public function access(Role $role, string $id)
    {
        $role = Role::findOrFail($id);
        // Group permissions by type to reduce queries
        $permissions = Permission::whereIn('slug', [
            'products.index',
            'products.create',
            'products.edit',
            'orders.index',
            'orders.create',
            'orders.edit',
            'categorys.index',
            'categorys.create',
            'categorys.edit',
            'brands.index',
            'brands.create',
            'brands.edit',
            'attributes.index',
            'attributes.create',
            'attributes.edit',
            'attribute_values.index',
            'attribute_values.create',
            'attribute_values.edit',
            'vouchers.index',
            'vouchers.create',
            'vouchers.edit',
        ])->get()->groupBy(function ($permission) {
            if (str_contains($permission->slug, 'products')) {
                return 'roleProduct';
            } elseif (str_contains($permission->slug, 'categorys')) {
                return 'roleCategory';
            } elseif (str_contains($permission->slug, 'orders')) {
                return 'roleOrder';
            } elseif (str_contains($permission->slug, 'brands')) {
                return 'roleBrand';
            } elseif (str_contains($permission->slug, 'attributes')) {
                return 'roleAttribute';
            } elseif (str_contains($permission->slug, 'attribute_values')) {
                return 'roleAttributeValue';
            } elseif (str_contains($permission->slug, 'permissions')) {
                return 'rolePermission';
            } elseif (str_contains($permission->slug, 'vouchers')) {
                return 'roleVouchers';
            } elseif (str_contains($permission->slug, 'sales')) {
                return 'roleSales';
            } elseif (str_contains($permission->slug, 'blogs')) {
                return 'roleBlogs';
            }
        });

        // Pass grouped permissions to the view
        return view('admin.roles.grant', [
            'role' => $role,
            'roleProduct' => $permissions->get('roleProduct') ?? collect(),
            'roleOrder' => $permissions->get('roleOrder') ?? collect(),
            'roleCategory' => $permissions->get('roleCategory') ?? collect(),
            'roleBrand' => $permissions->get('roleBrand') ?? collect(),
            'roleAttribute' => $permissions->get('roleAttribute') ?? collect(),
            'roleAttribute_value' => $permissions->get('roleAttributeValue') ?? collect(),
            'rolePermission' => $permissions->get('rolePermission') ?? collect(),
            'roleVouchers' => $permissions->get('roleVouchers') ?? collect(),
            'roleSales' => $permissions->get('roleSales') ?? collect(),
            'roleBlogs' => $permissions->get('roleBlogs') ?? collect(),
        ]);
    }

    public function updateGant(Request $request)
    {
        // dd($request->all());
        if (!empty($request->permissions)) {
            foreach ($request->permissions as $roleId => $permissionIds) {
                $role = Role::find($roleId);

                if ($role) {
                    // Đồng bộ quyền đã chọn với role (sẽ xóa quyền cũ nếu không được chọn)
                    $role->permissions()->sync($permissionIds);
                }
            }
        } else {
            // Trường hợp không có quyền nào được chọn
            return back()->with('errors', 'Không có quyền nào được chọn.');
        }


        return redirect()->back()->with('success', 'Cập nhật quyền thành công!');
    }
}
