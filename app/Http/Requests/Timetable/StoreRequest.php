<?php

namespace App\Http\Requests\Timetable;

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
        $rules=[
            '*.day' => 'required|not_in:none',
            '*.subject_user_id' => 'integer',
            '*.lesson' => 'required',
            '*.grade_id' => 'required|not_in:none',
            '*.classroom_id' => 'integer',
            '*.semester' => 'required|not_in:none'
        ];

        return $rules;
    }
}
