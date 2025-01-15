<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\attributes_name;
use Illuminate\Http\Request;

class AttributesNameController extends Controller
{
      /**
     * Danh sách thuộc tính
     */
    const PATH_VIEW = 'admin.attributes.';

    public function index()
    {
        $attributes = attributes_name::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    /**
     * Hiển thị form thêm mới thuộc tính
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Lưu thuộc tính mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'data_type' => 'required|string|max:255',
        ]);

        attributes_name::create([
            'name' => $request->name,
            // 'data_type' => $request->data_type,
        ]);

        return redirect()->route('attributes.index')->with('success', 'Thuộc tính đã được thêm mới.');
    }

    /**
     * Hiển thị form chỉnh sửa thuộc tính
     */
    public function edit($id)
    {
        $attribute = attributes_name::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    /**
     * Cập nhật thuộc tính
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attribute = attributes_name::findOrFail($id);
        $attribute->update([
            'name' => $request->name,
            'data_type' => $request->data_type,
        ]);

        return redirect()->route('attributes.index')->with('success', 'Thuộc tính đã được cập nhật.');
    }

    /**
     * Xóa thuộc tính
     */
    public function destroy($id)
    {
        $attribute = attributes_name::findOrFail($id);
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Thuộc tính đã được xóa.');
    }
}
