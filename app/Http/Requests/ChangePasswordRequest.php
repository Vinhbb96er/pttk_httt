<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Bạn chưa nhập mật khẩu cũ',
            'password.required' => 'Bạn chưa nhập mật khẩu mới',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng',
        ];
    }
}
