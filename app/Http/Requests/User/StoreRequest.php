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
        $rules = [
            'name' => 'required|min:4|max:20',
            'surname' => 'required|min:4|max:20',
            'patronymic' => 'required|min:4|max:20',
            'email' => 'required|email',
            'birthday' => 'required',
            'number' => 'required|min:9|max:13',
            'address' => 'required|max:255',
            'sex' => 'required',
            'role' => 'required',
            'password' =>"required|min:8|max:16"
        ];
        if($this['role']=='Ученик'){

            $rules['grade_id']="required";
        }
        return $rules;
    }
}
