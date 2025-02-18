<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép request được thực hiện
    }

    public function rules()
    {
        $brandId = $this->route('brand') ? $this->route('brand')->id : null;
    
        return [
            'name' => [
                'required', 
                'string', 
                'max:255', 
                'unique:brands,name,' . $brandId
            ],
            'text' => 'required|string', // Thêm required vào text để bắt buộc nhập mô tả
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Tên thương hiệu không được để trống.',
            'name.string' => 'Tên thương hiệu phải là chuỗi ký tự.',
            'name.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên thương hiệu đã tồn tại, vui lòng chọn tên khác.',
    
            'text.required' => 'Mô tả không được để trống.', // Thêm lỗi cho mô tả
            'text.string' => 'Mô tả phải là chuỗi ký tự.',
        ];
    }
    
}
