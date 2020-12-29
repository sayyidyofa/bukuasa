<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ImportDeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_create');
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:xls,xlsx'
        ];
    }
}