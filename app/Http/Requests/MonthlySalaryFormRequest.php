<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MonthlySalaryFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_access');
    }

    public function rules()
    {
        return [
            'month' => 'required|numeric',
            'year' => 'required|numeric'
        ];
    }
}