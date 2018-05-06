<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'birthday' => 'required|date|before:now',
            'gender' => 'required|boolean',
            'address' => 'required',
            'phone' => 'required|max:20',
            'insurance_number' => 'max:20',
            'reception_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Tên chỉ chứa tối đa 50 ký tự',
            'birthday.required' => 'Bạn chưa chọn ngày sinh',
            'birthday.date' => 'Không phải là ngày tháng',
            'birthday.before' => 'Ngày sinh phải trưóc ngày hiện tại',
            'gender.required' => 'Bạn chưa chọn giới tính',
            'gender.boolean' => 'Gía trị sai',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.max' => 'Số điện thoại chỉ chứa tối đa 20 ký tự',
            'insurance_number.max' => 'Mã BHYT chỉ chứa tối đa 20 ký tự',
            'reception_date.required' => 'Bạn chưa chọn ngày tiếp nhận',
            'reception_date.date' => 'Không phải là ngày tháng',
        ];
    }
}
