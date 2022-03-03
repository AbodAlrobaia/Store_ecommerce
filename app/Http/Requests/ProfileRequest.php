<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ProfileRequest extends FormRequest
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
            // 25
            'name'=>'required',
            'email'=>'required|email|unique:admins,email,'.$this->id, //     بنقول له يكو نيونك ب مش على الايميل الذي هو  داخل فيه $this->id
            'password'=>'Nullable|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required'    =>  'الرجا ادخال الاسم ',
            'email.required'   =>  'الرجاء اخال الايميل ',
            'email.email'      =>  'ضمن علامة @ لكي يكون إيميل حقيقي ',
            'email.unique'     =>  ' هذا الاميل موجود '
        ];
    }

}
