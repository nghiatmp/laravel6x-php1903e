<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginPost extends FormRequest
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
            'txtemail' =>'required|email',
            'txtpass' =>'required',
        ];
    }


    /*
    Thong bao loi
    */

    public function messages()
    {
        return [
            'txtemail.required' =>'Email không được trống',
            'txtemail.email'     =>'Định dạng email không đúng',
            'txtpass.required'  =>'Vui lòng nhập mật khẩu',
        ];
    }
}
