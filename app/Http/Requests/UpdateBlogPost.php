<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPost extends FormRequest
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
            "titlePost"     => 'required|max:200|min:5',
            "sapoPost"      => 'required|max:200|min:5',
            "languagePost"  => 'required|numeric',
            // 'avatar'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "catePost"      => 'required|numeric',
            "tagPost"       => 'required',
            "contentPost"   =>  'required|min:5',
            "status"        => 'required',
        ];
    }
    public function messages()
    {
        return [

            'titlePost.required' =>'Vui lòng nhập tiêu đề bài viết',
            'titlePost.max'      =>'Tiêu đề bài viết không lớn hơn :max kí tự',
            'titlePost.min'      =>'Tiêu đề bài viết không nhỏ hơn :min kí tự',
            // 'titlePost.unique'   =>'Tiêu đề bài viết đã tồn tại',


            'sapoPost.required'  =>'Vui lòng nhập miêu tả bài viết',
            'sapoPost.max'       =>'Miêu tả bài viết không lớn hơn :max kí tự',
            'sapoPost.min'       =>'Miêu tả bài viết không nhỏ hơn :min kí tự',


            // 'avatar.required'    =>'Vui lòng chọn ảnh bài viết',
            // 'avatar.mimes'       =>'Định dạng chỉ cho phép đăng ảnh la jepg,bmp,png,jpg,gif',

            'languagePost.required' =>'Vui lòng nhập ngôn ngữ  bài viết',
            'languagePost.numeric'=>'Ngôn ngữ bạn chọn không đc hỗ trợ',

            'catePost.required' =>'Vui lòng chọn danh mục bài viết  bài viết',
            'catePost.numeric'  =>'Danh mục  bạn chọn không tồn tại',

            'tagPost.required'   =>'Vui lòng chọn Tag bài viết',

            'contentPost.required' =>'Vui lòng nhập nội dung bài viết',
            'contentPost.min'      =>'Nội dung bài viết không lớn hơn :min kí tự',

            'status.required'       =>' Vui lòng chọn tình trạng bài viết ',



        ];
    }
}
