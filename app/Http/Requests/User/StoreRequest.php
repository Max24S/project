<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'surname' => 'required|min:3|max:20',
            'patronymic' => 'required|max:20',
            'email' => 'required|email',
            'birthday' => 'required',
            'birthday' => 'required',
            'number' => 'required|min:9|max:13'
        ];
    }
}
