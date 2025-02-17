<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttributesNameController extends Controller
{
    /**
     * Danh sách thuộc tính
     */
    const PATH_VIEW = 'admin.attributes.';

    public function index()
    {
        $attributes = Attribute::all();
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
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:attributes,name',
                // 'data_type' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Thuộc tính này không được bỏ trống.',
                'name.unique' => 'Thuộc tính này đã tồn tại.',
                'name.max' => 'không được quá 255 kí tự',
            ]
        );
        try {
            //code...
            Attribute::create([
                'name' => $request->name,
                // 'data_type' => $request->data_type,
            ]);
            return redirect()->route('attributes.index')->with('success', 'Thuộc tính đã được thêm mới.');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());

            return back()
                ->with('error', 'Thêm thuộc tính không thành công')
                ->withInput();
        }
    }


    /**
     * Hiển thị form chỉnh sửa thuộc tính
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    /**
     * Cập nhật thuộc tính
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:attributes,name',
                // 'data_type' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Thuộc tính này không được bỏ trống.',
                'name.unique' => 'Thuộc tính này đã tồn tại.',
                'name.max' => 'không được quá 255 kí tự',

            ]
        );
        try {
            //code...
            $attribute = Attribute::findOrFail($id);
            $attribute->update([
                'name' => $request->name,
            ]);

            return redirect()->route('attributes.index')->with('success', 'Thuộc tính đã được cập nhật.');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());

            return back()
                ->with('error', 'cập nhật thuộc tính không thành công')
                ->withInput();
        }
    }

    /**
     * Xóa thuộc tính
     */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Thuộc tính đã được xóa.');
    }
}
