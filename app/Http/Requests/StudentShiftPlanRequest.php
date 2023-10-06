<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentShiftPlanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'student_shift_id' => 'required',
            'from' => 'required',
            'to' => 'required',
            'period_index' => 'required',
            'slot' => 'required'
        ];
    }
}
