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
            'pelanggan_id' => [
                'required',
                'integer',
            ],
            'id'    => [
                'required',
                'integer',
                'min:1',
                'max:2147483647',
            ],
            'tgl_faktur'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tagihan'      => [
                'required',
            ],
        ];
    }
}
