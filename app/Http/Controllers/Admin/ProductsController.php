<?php

namespace App\Http\Controllers\Admin;

use App\Models\attributes_name;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.products.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attribute = attributes_name::query()->get();
        $attribute_valute = attributes_name::query()->get();
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $dataProduct = $request->except(['variants', 'categories']);
        // dd($dataProduct);

        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']);
        // dd($dataProduct['slug']);

        if ($request->hasFile('img_thumbnail')) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
        }

        $product = Product::query()->create($dataProduct);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $products)
    {
        //
    }
}
