<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'address' => 'required',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'birthday' => 'required|date|before:now',
            'gender' => 'required|boolean',
            'role' => 'in:1,2,3',
            'status' => 'boolean',
            'image' => 'image',
            'account' => 'required|max:20|min:4',
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Tên chỉ chứa tối đa 50 ký tự',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.max' => 'Số điện thoại chỉ chứa tối đa 20 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Không phải là email',
            'birthday.required' => 'Bạn chưa chọn ngày sinh',
            'birthday.date' => 'Không phải là ngày tháng',
            'birthday.before' => 'Ngày sinh phải trưóc ngày hiện tại',
            'gender.required' => 'Bạn chưa chọn giới tính',
            'gender.boolean' => 'Gía trị sai',
            'role.in' => 'Gía trị sai',
            'status.boolean' => 'Gía trị sai',
            'image.image' => 'File đã chọn không phải là ảnh',
            'account.required' => 'Bạn chưa nhập tài khoản',
            'account.max' => 'Tài khoản chỉ chứa tối đa 20 ký tự',
            'account.min' => 'Tài khoản phải có ít nhất 4 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng',
        ];
    }
}
