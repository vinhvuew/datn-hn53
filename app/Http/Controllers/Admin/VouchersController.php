<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = voucher::all(); // Lấy tất cả các voucher
        return view('admin.vouchers.view', compact('vouchers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'voucher' => 'required|string|max:255|unique:vouchers,voucher',
            'name' => 'required|string|max:255',
            'valid_from' => 'required|date|before_or_equal:valid_to',
            'valid_to' => 'required|date|after_or_equal:valid_from',
        ], [
            'voucher.unique' => 'Voucher này đã tồn tại, vui lòng chọn mã khác.', // Thông báo lỗi tùy chỉnh
        ]);

        try {
            // Lưu voucher vào cơ sở dữ liệu
            Voucher::create([
                'voucher' => $request->voucher,
                'name' => $request->name,
                'valid_from' => $request->valid_from,
                'valid_to' => $request->valid_to,
            ]);

            // Sau khi lưu thành công, quay lại trang view của vouchers
            return redirect()->route('vouchers.view')->with('success', 'them thanh cong!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'them that bai ' . $e->getMessage()]);
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(voucher $vouchers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tìm voucher theo ID
        $voucher = Voucher::findOrFail($id);

        // Trả về form chỉnh sửa
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'voucher' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'valid_from' => 'required|date|before_or_equal:valid_to',
            'valid_to' => 'required|date|after_or_equal:valid_from',
        ]);

        try {
            // Tìm voucher theo ID và cập nhật
            $voucher = Voucher::findOrFail($id);
            $voucher->update([
                'voucher' => $request->voucher,
                'name' => $request->name,
                'valid_from' => $request->valid_from,
                'valid_to' => $request->valid_to,
            ]);

            return redirect()->route('vouchers.view')->with('success', 'Voucher updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while updating the voucher: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Tìm đơn hàng theo ID và xóa
            DB::table('vouchers')->where('id', $id)->delete();

            // Redirect với thông báo thành công
            return redirect()->route('vouchers.view')->with('success', 'Xóa đơn hàng thành công!');
        } catch (\Exception $e) {
            // Trường hợp lỗi
            return redirect()->route('vouchers.view')->with('error', 'Xóa đơn hàng thất bại!');
        }
    }
}
