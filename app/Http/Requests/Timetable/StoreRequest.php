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
            'day'=>'required|not_in:default',
            'grade_id'=>'required|not_in:default',
            'semester'=>'required|not_in:default',
        ];
        for ($i=1;$i<=8;$i++)
        {
            $rules['subject'.$i]='not_in:default';
            $rules['teach_id'.$i]='not_in:default';
        }
        return $rules;
    }
}
