<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'required|string|max:100|unique:products,sku',
            'quantity' => 'required|integer|min:0',
            'base_price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:base_price',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'user_manual' => 'nullable|string',
            'img_thumbnail' => 'nullable|image|max:2048',
            'product_galleries.*' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'is_good_deal' => 'boolean',
            'is_new' => 'boolean',
            'is_show_home' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Danh mục không được để trống.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'brand_id.required' => 'Thương hiệu không được để trống.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'sku.required' => 'Mã SKU không được để trống.',
            'sku.unique' => 'Mã SKU đã tồn tại.',
            'quantity.required' => 'Số lượng không được để trống.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng không thể nhỏ hơn 0.',
            'base_price.required' => 'Giá gốc không được để trống.',
            'base_price.numeric' => 'Giá gốc phải là số.',
            'base_price.min' => 'Giá gốc không thể nhỏ hơn 0.',
            'price_sale.numeric' => 'Giá giảm phải là số.',
            'price_sale.min' => 'Giá giảm không thể nhỏ hơn 0.',
            'price_sale.lt' => 'Giá giảm phải nhỏ hơn giá gốc.',
            'img_thumbnail.image' => 'Ảnh thumbnail phải là định dạng hình ảnh.',
            'img_thumbnail.max' => 'Ảnh thumbnail không được vượt quá 2MB.',
            'product_galleries.*.image' => 'Ảnh trong thư viện sản phẩm phải là định dạng hình ảnh.',
            'product_galleries.*.max' => 'Ảnh trong thư viện sản phẩm không được vượt quá 2MB.',
        ];
    }
    // public function rules()
    // {
    //     $rules = [
    //         'category_id' => 'required|exists:categories,id',
    //         'brand_id' => 'required|exists:brands,id',
    //         'name' => 'required|string|max:255|unique:products,name',
    //         'sku' => 'required|string|max:100|unique:products,sku',
    //         'quantity' => 'required|integer|min:0',
    //         'base_price' => 'required|numeric|min:0',
    //         'price_sale' => 'nullable|numeric|min:0|lt:base_price',
    //         'description' => 'nullable|string',
    //         'content' => 'nullable|string',
    //         'user_manual' => 'nullable|string',
    //         'img_thumbnail' => 'nullable|image|max:2048',
    //         'product_galleries.*' => 'nullable|image|max:2048',
    //         'is_active' => 'boolean',
    //         'is_good_deal' => 'boolean',
    //         'is_new' => 'boolean',
    //         'is_show_home' => 'boolean',

    //         // Validation for attributes
    //         'attributes.*.name' => 'required|string|max:255',
    //         'attributes.*.data_type' => 'required|string|in:string,integer,boolean,float,date',
    //         'attribute_values.*.attribute_id' => 'required|exists:attributes,id',
    //         'attribute_values.*.value' => 'required|string|max:255',
    //     ];

    //     // Only apply validation for variants if they exist in the request
    //     if ($this->has('variants')) {
    //         $rules = array_merge($rules, [
    //             'variants.*.sku' => 'required|string|unique:variants,sku',
    //             'variants.*.image' => 'nullable|image|max:2048',
    //             'variants.*.quantity' => 'required|integer|min:0',
    //             'variants.*.wholesale_price' => 'required|numeric|min:0',
    //             'variants.*.selling_price' => 'required|numeric|min:0|gte:variants.*.wholesale_price',
    //         ]);
    //     }

    //     return $rules;
    // }

    // public function messages()
    // {
    //     return [
    //         'category_id.required' => 'Danh mục không được để trống.',
    //         'category_id.exists' => 'Danh mục không hợp lệ.',
    //         'brand_id.required' => 'Thương hiệu không được để trống.',
    //         'brand_id.exists' => 'Thương hiệu không hợp lệ.',
    //         'name.required' => 'Tên sản phẩm không được để trống.',
    //         'name.unique' => 'Tên sản phẩm đã tồn tại.',
    //         'sku.required' => 'Mã SKU không được để trống.',
    //         'sku.unique' => 'Mã SKU đã tồn tại.',
    //         'quantity.required' => 'Số lượng không được để trống.',
    //         'quantity.integer' => 'Số lượng phải là số nguyên.',
    //         'quantity.min' => 'Số lượng không thể nhỏ hơn 0.',
    //         'base_price.required' => 'Giá gốc không được để trống.',
    //         'base_price.numeric' => 'Giá gốc phải là số.',
    //         'base_price.min' => 'Giá gốc không thể nhỏ hơn 0.',
    //         'price_sale.numeric' => 'Giá giảm phải là số.',
    //         'price_sale.min' => 'Giá giảm không thể nhỏ hơn 0.',
    //         'price_sale.lt' => 'Giá giảm phải nhỏ hơn giá gốc.',
    //         'img_thumbnail.image' => 'Ảnh thumbnail phải là định dạng hình ảnh.',
    //         'img_thumbnail.max' => 'Ảnh thumbnail không được vượt quá 2MB.',
    //         'product_galleries.*.image' => 'Ảnh trong thư viện sản phẩm phải là định dạng hình ảnh.',
    //         'product_galleries.*.max' => 'Ảnh trong thư viện sản phẩm không được vượt quá 2MB.',

    //         // Messages for variants
    //         'variants.*.sku.required' => 'SKU biến thể không được để trống.',
    //         'variants.*.sku.unique' => 'SKU biến thể đã tồn tại.',
    //         'variants.*.quantity.required' => 'Số lượng biến thể không được để trống.',
    //         'variants.*.quantity.integer' => 'Số lượng biến thể phải là số nguyên.',
    //         'variants.*.quantity.min' => 'Số lượng biến thể không thể nhỏ hơn 0.',
    //         'variants.*.wholesale_price.required' => 'Giá sỉ không được để trống.',
    //         'variants.*.wholesale_price.numeric' => 'Giá sỉ phải là số.',
    //         'variants.*.wholesale_price.min' => 'Giá sỉ không thể nhỏ hơn 0.',
    //         'variants.*.selling_price.required' => 'Giá bán không được để trống.',
    //         'variants.*.selling_price.numeric' => 'Giá bán phải là số.',
    //         'variants.*.selling_price.min' => 'Giá bán không thể nhỏ hơn 0.',
    //         'variants.*.selling_price.gte' => 'Giá bán phải lớn hơn hoặc bằng giá sỉ.',

    //         // Messages for attributes
    //         'attributes.*.name.required' => 'Tên thuộc tính không được để trống.',
    //         'attributes.*.data_type.required' => 'Kiểu dữ liệu không được để trống.',
    //         'attributes.*.data_type.in' => 'Kiểu dữ liệu không hợp lệ.',
    //         'attribute_values.*.attribute_id.required' => 'ID thuộc tính không được để trống.',
    //         'attribute_values.*.attribute_id.exists' => 'Thuộc tính không hợp lệ.',
    //         'attribute_values.*.value.required' => 'Giá trị thuộc tính không được để trống.',
    //     ];
    // }
}
