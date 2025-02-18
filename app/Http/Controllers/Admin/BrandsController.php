<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest; // Import Form Request

class BrandsController extends Controller
{
    const PATH_VIEW = 'admin.brands.';

    // Hiển thị danh sách thương hiệu
    public function index()
    {
        $brands = Brand::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
    }

    // Hiển thị form thêm mới thương hiệu
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    // Lưu thương hiệu mới vào DB (CÓ VALIDATE)
    public function store(BrandRequest $request) // Dùng BrandRequest thay vì Request
    {
        dd($request->validated()); 
        Brand::create($request->validated()); // Validate tự động trước khi lưu
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa thương hiệu
    public function edit(Brand $brand)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    // Cập nhật thương hiệu (CÓ VALIDATE)
    public function update(BrandRequest $request, Brand $brand) // Dùng BrandRequest thay vì Request
    {
        $brand->update($request->validated()); // Validate tự động trước khi cập nhật
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật.');
    }

    // Xóa thương hiệu
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xóa.');
    }
}
