<?php

namespace App\Http\Controllers\Admin;


use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\image_gallery;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with([
            'variants.attributes' => function ($query) {
                $query->with('attribute', 'attributeValue');
            }
        ])->get();
        // dd($products);

        // dd($products);
        return view('admin.products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::query()->get();
        $brands = Brand::query()->get();
        $attributes = Attribute::query()->get();
        return view('admin.products.create', compact('attributes', 'category', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $dataProduct = $request->except(['product_galleries', 'variants', 'categories', 'brands']);
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

            if (!empty($request->product_galleries)) {
                foreach ($request->product_galleries as $imgGalerie) {
                    image_gallery::query()->create([
                        'product_id' => $product->id,
                        'img' => Storage::put('galleries', $imgGalerie)
                    ]);
                }
            }

            foreach ($request->variants as $variantData) {
                // dd($variants);
                if (!empty($variantData['sku'])) {
                    $variant = Variant::query()->create([
                        'product_id' => $product->id,
                        'sku' => $variantData['sku'] ?? 0,
                        'image' => Storage::put('varians', $variantData['image']),
                        'quantity' => $variantData['quantity'] ?? 0,
                        'wholesale_price' => $variantData['wholesale_price'] ?? 0,
                        'selling_price' => $variantData['selling_price'] ?? 0
                    ]);
                }
                if (!empty($variantData['attributes'])) {
                    foreach ($variantData['attributes'] as $key => $value) {
                        if ($value) {
                            $variant->attributes()->create([
                                'variant_id' => $variant->id,
                                'attribute_id' => $key,
                                'attribute_value_id' => $value,
                            ]);
                        }
                    }
                }
            }
            return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
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
