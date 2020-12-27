<?php

namespace App\Http\Requests;

use App\Models\Pelanggan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePelangganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pelanggan_create');
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'contact' => [
                'string',
                'nullable',
            ],
        ];
    }
}
