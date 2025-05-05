<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class VouchersController extends Controller
{
    /**
     * Hiển thị danh sách voucher.
     */
    const OBJECT = 'vouchers';
    public function index()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
    
        // Tự động cập nhật các voucher hết hạn
        Voucher::where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '<', Carbon::now())
            ->update(['status' => 'expired']);
    
        $vouchers = Voucher::all(); // Lấy tất cả các voucher
        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Hiển thị form tạo voucher.
     */
    public function create()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        return view('admin.vouchers.create');
    }

    /**
     * Lưu voucher mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code',
            'name' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,disabled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'quantity' => 'nullable|integer|min:1',
        ], [
            // Thông báo lỗi tiếng Việt
            'code.required' => 'Vui lòng nhập mã voucher.',
            'code.string' => 'Mã voucher phải là chuỗi.',
            'code.max' => 'Mã voucher không được vượt quá 255 ký tự.',
            'code.unique' => 'Mã voucher đã tồn tại.',

            'name.required' => 'Vui lòng nhập tên voucher.',
            'name.string' => 'Tên voucher phải là chuỗi.',
            'name.max' => 'Tên voucher không được vượt quá 255 ký tự.',

            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',

            'discount_value.required' => 'Vui lòng nhập giá trị giảm.',
            'discount_value.numeric' => 'Giá trị giảm phải là số.',
            'discount_value.min' => 'Giá trị giảm không được nhỏ hơn 0.',

            'min_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là số.',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu không được nhỏ hơn 0.',

            'max_discount_value.numeric' => 'Giá trị giảm tối đa phải là số.',
            'max_discount_value.min' => 'Giá trị giảm tối đa không được nhỏ hơn 0.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',

            'start_date.date' => 'Ngày bắt đầu không đúng định dạng.',
            'end_date.date' => 'Ngày kết thúc không đúng định dạng.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',

            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải ít nhất là 1.',
        ]);


        try {
            Voucher::create($request->all());
            return redirect()->route('vouchers.index')->with('success', 'Thêm voucher thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Lỗi khi thêm voucher: ' . $e->getMessage()]);
        }
    }

    /**
     * Hiển thị form chỉnh sửa voucher.
     */
    public function edit($id)
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $voucher = Voucher::findOrFail($id); // Lấy voucher theo id
        return view('admin.vouchers.edit', compact('voucher')); // Truyền biến voucher vào view
    }

    /**
     * Cập nhật thông tin voucher.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,disabled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'quantity' => 'nullable|integer|min:1',
        ], [
            // Thông báo lỗi tiếng Việt
            'code.required' => 'Vui lòng nhập mã voucher.',
            'code.string' => 'Mã voucher phải là chuỗi.',
            'code.max' => 'Mã voucher không được vượt quá 255 ký tự.',
            

            'name.required' => 'Vui lòng nhập tên voucher.',
            'name.string' => 'Tên voucher phải là chuỗi.',
            'name.max' => 'Tên voucher không được vượt quá 255 ký tự.',

            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ.',

            'discount_value.required' => 'Vui lòng nhập giá trị giảm.',
            'discount_value.numeric' => 'Giá trị giảm phải là số.',
            'discount_value.min' => 'Giá trị giảm không được nhỏ hơn 0.',

            'min_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là số.',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu không được nhỏ hơn 0.',

            'max_discount_value.numeric' => 'Giá trị giảm tối đa phải là số.',
            'max_discount_value.min' => 'Giá trị giảm tối đa không được nhỏ hơn 0.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',

            'start_date.date' => 'Ngày bắt đầu không đúng định dạng.',
            'end_date.date' => 'Ngày kết thúc không đúng định dạng.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',

            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải ít nhất là 1.',
        ]);

        try {
            $voucher = Voucher::findOrFail($id);
            $voucher->update($request->all());
            return redirect()->route('vouchers.index')->with('success', 'Cập nhật voucher thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Lỗi khi cập nhật voucher: ' . $e->getMessage()]);
        }
    }

    /**
     * Xóa voucher.
     */
    public function destroy($id)
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        try {
            Voucher::findOrFail($id)->delete();
            return redirect()->route('vouchers.index')->with('success', 'Xóa voucher thành công!');
        } catch (\Exception $e) {
            return redirect()->route('vouchers.index')->with('error', 'Lỗi khi xóa voucher: ' . $e->getMessage());
        }
    }
}
