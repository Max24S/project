<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=>['string', 'max:6', 'unique:grades,name,'.$this['id']],
            'user_id'=>['integer', 'unique:grades,user_id,'.$this['id']],
            'classroom_id'=>['integer','unique:grades,classroom_id,'.$this['id']],
        ];
    }
}
