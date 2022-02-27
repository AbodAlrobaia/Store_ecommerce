<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Enumerations\CategoryType;

class GeneralProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'slug' =>  'required|unique' ,      // هذا التايب تبع الراديو بتوم ضروري يكن متطلب وايضا يجي بقيمتين يا صفر يا واحد  type
            'slug' => 'required|unique:products,slug,'.$this->id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:300',
            'categories' => 'array|min:1' ,   //   هذا ضروري يجي مصفووفه وعلى الاقل يجي معه واحد
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable|array|min:1',
            'brand_id' => 'required|exists:brands,id' ,
        ];
    }
}
