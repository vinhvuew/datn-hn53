<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\image_gallery;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const OBJECT = 'products';
    public function index()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
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
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $category = Category::query()->get();
        $brands = Brand::query()->get();
        $attributes = Attribute::query()->get();
        return view('admin.products.create', compact('attributes', 'category', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
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
                        // 'wholesale_price' => $variantData['wholesale_price'] ?? 0,
                        // 'selling_price' => $variantData['selling_price'] ?? 0
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

    public function show(Product $product)
    {
        $product = Product::with('category', 'brand', 'images', 'variants')->findOrFail($product->id);
        // dd($product);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $category = Category::query()->get();
        $brands = Brand::query()->get();
        $attributes = Attribute::query()->get();
        $product = Product::with('category', 'brand', 'images', 'variants')->findOrFail($product->id);
        // dd($product);
        return view('admin.products.edit', compact('category', 'brands', 'attributes', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        try {
            DB::transaction(function () use ($request, $product) {
                $dataProduct = $request->except(['product_galleries', 'variants', 'categories', 'brands']);
                $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
                $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
                $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
                $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
                $dataProduct['slug'] = Str::slug($dataProduct['name']);

                if ($request->hasFile('img_thumbnail')) {
                    // xóa ảnh cũ
                    if ($product->img_thumbnail) {
                        Storage::delete($product->img_thumbnail);
                    }
                    // Lưu ảnh mới
                    $dataProduct['img_thumbnail'] = Storage::put('products', $request->file('img_thumbnail'));
                } else {
                    // Giữ nguyên ảnh cũ
                    $dataProduct['img_thumbnail'] = $product->img_thumbnail ?? null;
                }

                $product->update($dataProduct);

                // xử lý Gallery
                if ($request->hasFile('product_galleries')) {
                    foreach ($request->file('product_galleries') as $key => $file) {
                        if (Str::startsWith($key, 'new_')) {
                            $path = $file->store('galleries', 'public');
                            $product->images()->create([
                                'img' => $path
                            ]);
                        } else {
                            $gallery = $product->images()->find($key);
                            if ($gallery) {
                                Storage::delete($gallery->img);
                                $path = $file->store('galleries', 'public');
                                $gallery->update(
                                    [
                                        'img' => $path
                                    ]
                                );
                            }
                        }
                    }
                }

                // Kiểm tra và xử lý biến thể
                if ($request->has('variants')) {
                    foreach ($request->input('variants') as $key => $variantData) {
                        $isNew = Str::startsWith($key, 'new_');

                        if ($isNew) {
                            // Tạo biến thể mới
                            $variant = $product->variants()->create([
                                'sku' => $variantData['sku'],
                                'quantity' => $variantData['quantity'],
                                'image' => '',
                            ]);
                        } else {
                            // Tìm biến thể cũ
                            $variant = $product->variants()->find($key);
                            if (!$variant) continue; // Bỏ qua nếu không tìm thấy

                            // Cập nhật biến thể cũ
                            $variant->update([
                                'sku' => $variantData['sku'],
                                'quantity' => $variantData['quantity'],
                            ]);
                        }

                        // Xử lý hình ảnh
                        if ($request->hasFile("variants.$key.image")) {
                            $imagePath = $request->file("variants.$key.image")->store('variants', 'public');
                            $variant->update(['image' => $imagePath]);
                        }

                        // Cập nhật attributes nếu có
                        if (!empty($variantData['attributes'])) {
                            $variant->attributes()->delete(); // Xóa thuộc tính cũ
                            foreach ($variantData['attributes'] as $attributeId => $valueId) {
                                if ($valueId) {
                                    $variant->attributes()->create([
                                        'attribute_id' => $attributeId,
                                        'attribute_value_id' => $valueId,
                                    ]);
                                }
                            }
                        }
                    }
                }

                // Nếu sản phẩm chưa có biến thể, tự động thêm biến thể mặc định
                if ($product->variants()->count() == 0 && !empty($request->variants)) {
                    foreach ($request->variants as $variantData) {
                        if (!empty($variantData['sku'])) {
                            $variant = $product->variants()->create([
                                'sku' => $variantData['sku'],
                                'quantity' => $variantData['quantity'] ?? 0,
                                'image' => $request->hasFile("variants.$key.image")
                                    ? $request->file("variants.$key.image")->store('variants', 'public')
                                    : null,
                            ]);

                            // Thêm attributes
                            if (!empty($variantData['attributes'])) {
                                foreach ($variantData['attributes'] as $attributeId => $valueId) {
                                    if ($valueId) {
                                        $variant->attributes()->create([
                                            'attribute_id' => $attributeId,
                                            'attribute_value_id' => $valueId,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }, 3);
            return back()->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $products)
    {
        //
    }
}
