<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    const PATH_VIEW = 'admin.brands.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all(); // Lấy tất cả thương hiệu từ DB
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
    }

    // Hiển thị form thêm mới thương hiệu
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    // Lưu thương hiệu mới vào DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Brand::create($request->all()); // Thêm mới thương hiệu
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa thương hiệu
    public function edit(Brand $brand)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    // Cập nhật thương hiệu
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $brand->update($request->all());
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật.');
    }

    // Xóa thương hiệu
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xóa.');
    }
}
