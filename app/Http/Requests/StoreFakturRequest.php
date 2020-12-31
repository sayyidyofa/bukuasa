<?php

namespace App\Http\Requests;

use App\Models\Faktur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFakturRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('faktur_create');
    }

    public function rules()
    {
        return [
            'pelanggan_id' => [
                'required',
                'integer',
            ],
            'no_faktur'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:fakturs,no_faktur',
            ],
            'tgl_faktur'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tagihan'      => [
                'required',
            ],
            'photo'        => [
                'required',
            ],
        ];
    }
}
