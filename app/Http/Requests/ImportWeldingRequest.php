<?php


namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ImportWeldingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('welding_create');
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:xls,xlsx'
        ];
    }
}