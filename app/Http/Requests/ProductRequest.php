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
            'name' => 'required|string|unique:products,name',
            'sku' => 'required|string|max:255|unique:products,sku',
            'quantity' => 'required|integer|min:0',
            'base_price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'user_manual' => 'nullable|string',
            'img_thumbnail' => 'nullable|image|max:2048',
            'product_galleries.*' => 'nullable|image|max:2048',

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
            'img_thumbnail.image' => 'Ảnh thumbnail phải là định dạng hình ảnh.',
            'img_thumbnail.max' => 'Ảnh thumbnail không được vượt quá 2MB.',
            'product_galleries.*.image' => 'Ảnh trong thư viện sản phẩm phải là định dạng hình ảnh.',
            'product_galleries.*.max' => 'Ảnh trong thư viện sản phẩm không được vượt quá 2MB.',
        ];
    }

}
