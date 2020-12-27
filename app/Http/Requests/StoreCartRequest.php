<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_create');
    }

    public function rules()
    {
        return [
            'faktur_id'   => [
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
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
