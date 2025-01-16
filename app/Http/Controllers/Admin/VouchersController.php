<?php

namespace App\Http\Controllers\Admin;

use App\Models\vouchers;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = vouchers::all(); // Lấy tất cả các voucher
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
            'voucher' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'valid_from' => 'required|date|before_or_equal:valid_to',
            'valid_to' => 'required|date|after_or_equal:valid_from',
        ]);
    
        try {
            // Lưu voucher vào cơ sở dữ liệu
            Vouchers::create([
                'voucher' => $request->voucher,
                'name' => $request->name,
                'valid_from' => $request->valid_from,
                'valid_to' => $request->valid_to,
            ]);
    
            return redirect()->route('voucher.index')->with('success', 'Voucher added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while saving the voucher: ' . $e->getMessage()]);
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(vouchers $vouchers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vouchers $vouchers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vouchers $vouchers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vouchers $vouchers)
    {
        //
    }
}
