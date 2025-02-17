<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' =>'required|email|max:255|unique:users,email',
            'phone' =>'required|string|max:10|unique:users,phone',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Địa Chỉ Email Đã Tồn Tại!',
            'phone.unique' => 'Số Điện Thoại Đã Tồn Tại!',
            'password.confirmed' => 'Mật Khẩu Xác Nhận  Không Khớp!',
        ];

}
}
