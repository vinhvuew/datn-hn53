<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VouchersController extends Controller
{
    /**
     * Hiển thị danh sách voucher.
     */
    public function index()
    {
        $vouchers = Voucher::all(); // Lấy tất cả các voucher
        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Hiển thị form tạo voucher.
     */
    public function create()
    {
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
        $voucher = Voucher::findOrFail($id); // Lấy voucher theo id
        return view('admin.vouchers.edit', compact('voucher')); // Truyền biến voucher vào view
    }

    /**
     * Cập nhật thông tin voucher.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code,' . $id,
            'name' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,disabled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
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
            Voucher::findOrFail($id)->delete();
            return redirect()->route('vouchers.index')->with('success', 'Xóa voucher thành công!');
        } catch (\Exception $e) {
            return redirect()->route('vouchers.index')->with('error', 'Lỗi khi xóa voucher: ' . $e->getMessage());
        }
    }
}