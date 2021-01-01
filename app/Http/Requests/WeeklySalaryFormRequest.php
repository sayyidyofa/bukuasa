<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class WeeklySalaryFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_access');
    }

    public function rules()
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }
}