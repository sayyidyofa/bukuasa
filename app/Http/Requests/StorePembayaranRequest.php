<?php

namespace App\Http\Requests;

use App\Models\Pembayaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePembayaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pembayaran_create');
    }

    public function rules()
    {
        return [
            'faktur_id'     => [
                'required',
                'integer',
            ],
            'type'          => [
                'required',
            ],
            'holder'        => [
                'required',
            ],
            'nth_payment'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'nominal'       => [
                'required',
            ],
            'payment_date'  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'keterangan'    => [
                'string',
                'nullable',
            ],
            'payment_proof' => [
                'required',
            ],
        ];
    }
}
