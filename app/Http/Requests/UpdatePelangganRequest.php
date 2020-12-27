<?php

namespace App\Http\Requests;

use App\Models\Pelanggan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePelangganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pelanggan_edit');
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
