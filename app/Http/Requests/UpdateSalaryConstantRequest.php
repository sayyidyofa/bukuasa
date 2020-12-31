<?php

namespace App\Http\Requests;

use App\Models\SalaryConstant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSalaryConstantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('salary_constant_edit');
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
                'unique:salary_constants,name,' . request()->route('salary_constant')->id,
            ],
            'nominal' => [
                'required',
            ],
        ];
    }
}
