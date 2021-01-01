<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class WeeklySalaryProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_create');
    }

    public function rules()
    {
        return [
            'from' => 'required',
            'to' => 'required',
            'nominal-.*' => 'required|numeric',
            'id-.*' => 'required|numeric',
            'markup-.*' => 'required|numeric',
            'keterangan-.*' => 'nullable'
        ];
    }
}