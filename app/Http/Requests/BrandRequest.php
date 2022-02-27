<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            // 'category' => 'required|array|min:1',
            'name' => 'required',
            //  على شان في حالة التحديث ما يكن متطلب لان احنا استخدمنا للكرييت والابديت نفس الركوست نفس التحقق without:id فعلنا
            'photo' => 'required_without:id|mimes:png,jpg,jpeg',
        ];
    }
}
