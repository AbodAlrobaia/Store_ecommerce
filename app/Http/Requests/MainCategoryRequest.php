<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Enumerations\CategoryType;

class MainCategoryRequest extends FormRequest
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
            'type' =>  'required|in:1,2' ,      // هذا التايب تبع الراديو بتوم ضروري يكن متطلب وايضا يجي بقيمتين يا صفر يا واحد  type
            'slug' => 'required|unique:categories,slug,'.$this->id,
        ];
    }
}
