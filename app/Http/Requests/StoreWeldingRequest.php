<?php

namespace App\Http\Requests;

use App\Models\Welding;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWeldingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('welding_create');
    }

    public function rules()
    {
        return [
            'date'        => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'user_id'     => [
                'required',
                'integer',
            ],
            'product_id'  => [
                'required',
                'integer',
            ],
            'weight_kg'   => [
                'numeric',
                'required',
            ],
            'amount_unit' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
