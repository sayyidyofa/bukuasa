<?php

namespace App\Http\Requests;

use App\Models\Faktur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFakturRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('faktur_edit');
    }

    public function rules()
    {
        return [
            'no_faktur'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:fakturs,no_faktur,' . request()->route('faktur')->id,
            ],
            'tgl_faktur'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tagihan'       => [
                'required',
            ],
            'diskon_markup' => [
                'required',
            ],
        ];
    }
}
