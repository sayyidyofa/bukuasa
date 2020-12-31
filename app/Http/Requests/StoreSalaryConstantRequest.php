<?php

namespace App\Http\Requests;

use App\Models\SalaryConstant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSalaryConstantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_constant_create');
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
                'unique:salary_constants',
            ],
            'nominal' => [
                'required',
            ],
        ];
    }
}
