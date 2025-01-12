<?php

namespace App\Http\Controllers;
use App\Models\Brands;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Hiển thị danh sách thương hiệu
    public function index()
    {
        $brands = Brands::all(); // Lấy tất cả thương hiệu từ DB
        return view('brands.index', compact('brands'));
    }

    // Hiển thị form thêm mới thương hiệu
    public function create()
    {
        return view('brands.create');
    }

    // Lưu thương hiệu mới vào DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Brands::create($request->all()); // Thêm mới thương hiệu
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa thương hiệu
    public function edit(Brands $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    // Cập nhật thương hiệu
    public function update(Request $request, Brands $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $brand->update($request->all());
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật.');
    }

    // Xóa thương hiệu
    public function destroy(Brands $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xóa.');
    }
}
