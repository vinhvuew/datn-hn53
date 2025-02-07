<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttributesValuesController extends Controller
{
    const PATH_VIEW = 'admin.attribute_values.';

    /**
     * Danh sách giá trị thuộc tính.
     */
    public function index()
    {
        $values = AttributeValue::with('attribute')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('values'));
    }

    /**
     * Hiển thị form thêm mới giá trị thuộc tính.
     */
    public function create()
    {
        $attributes = Attribute::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    /**
     * Lưu giá trị thuộc tính mới.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $data = $request->validate(
            [
                'value' => 'required|max:255|unique:attribute_values,value',
                'attribute_id' => 'required|exists:attributes,id',
            ],
            [
                'value.required' => 'Giá trị Thuộc tính không được bỏ trống.',
                'value.unique' => 'Giá trị Thuộc tính này đã tồn tại.',
                'value.max' => 'không được quá 255 kí tự',
                'attribute_id' => 'Thuộc tính không được bỏ trống.',

            ]
        );
        // dd($data);

        try {
            // Tạo giá trị thuộc tính
            AttributeValue::create($data);
            // dd($data);
            return redirect()->route('attribute-values.index')
                ->with('success', 'Thêm giá trị thuộc tính thành công');
        } catch (\Throwable $th) {
            // Ghi log lỗi và trả về thông báo
            Log::error($th->getMessage());

            return back()
                ->with('error', 'Thêm giá trị thuộc tính không thành công')
                ->withInput();
        }
    }


    /**
     * Hiển thị form chỉnh sửa giá trị thuộc tính.
     */
    public function edit($id)
    {
        $value = AttributeValue::findOrFail($id);
        $attributes = Attribute::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('value', 'attributes'));
    }

    /**
     * Cập nhật giá trị thuộc tính.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'attribute_id' => 'required|exists:attributes,id',
                'value' => 'required|string|max:255|unique:attribute_values,value',
            ],
            [
                'value.required' => 'Giá trị Thuộc tính không được bỏ trống.',
                'value.unique' => 'Giá trị Thuộc tính này đã tồn tại.',
                'value.max' => 'không được quá 255 kí tự',
            ]
        );
        try {
            //code...
            $value = AttributeValue::findOrFail($id);
            $value->update([
                // 'attributes_name_id' => $request->attributes_name_id,
                'value' => $request->value,
            ]);
            return redirect()->route('attribute-values.index')->with('success', 'Giá trị thuộc tính đã được cập nhật.');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());

            return back()
                ->with('error', 'Cập nhật giá trị thuộc tính không thành công')
                ->withInput();
        }
    }

    /**
     * Xóa giá trị thuộc tính.
     */
    public function destroy($id)
    {
        $value = AttributeValue::findOrFail($id);
        $value->delete();

        return redirect()->route('attribute-values.index')->with('success', 'Giá trị thuộc tính đã được xóa.');
    }
}
