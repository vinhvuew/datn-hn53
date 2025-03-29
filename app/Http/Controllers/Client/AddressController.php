<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'province' => 'required|string', // Lưu tên tỉnh
            'district' => 'required|string', // Lưu tên huyện
            'ward' => 'required|string', // Lưu tên xã
            'address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        Address::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => $request->province, // Lưu tên tỉnh
            'district' => $request->district, // Lưu tên huyện
            'ward' => $request->ward, // Lưu tên xã
            'address' => $request->address,
            'note' => $request->note,
            'user_id' => Auth::id(),
            'is_default' => $request->has('is_default'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Địa chỉ đã được thêm thành công!'
        ]);
    }

    public function show($id)
    {
        $address = Address::where('user_id', Auth::id())
                         ->where('id', $id)
                         ->firstOrFail();
        
        return response()->json($address);
    }

    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', Auth::id())
                         ->where('id', $id)
                         ->firstOrFail();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $address->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'address' => $request->address,
            'note' => $request->note,
            'is_default' => $request->has('is_default'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Địa chỉ đã được cập nhật thành công!'
        ]);
    }

    public function destroy($id)
    {
        try {
            $address = Address::where('user_id', Auth::id())
                            ->where('id', $id)
                            ->firstOrFail();

            $address->delete();

            return response()->json([
                'success' => true,
                'message' => 'Địa chỉ đã được xóa thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa địa chỉ này!'
            ], 400);
        }
    }
}