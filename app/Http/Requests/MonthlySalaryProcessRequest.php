<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MonthlySalaryProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_create');
    }

    public function rules()
    {
        return [

        ];
    }
}