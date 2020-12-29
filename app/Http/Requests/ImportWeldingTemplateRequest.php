<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ImportWeldingTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_access');
    }

    public function rules()
    {
        return [
            'date' => 'required|date'
        ];
    }
}