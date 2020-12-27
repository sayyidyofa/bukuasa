<?php

namespace App\Http\Requests;

use App\Models\Delivery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_edit');
    }

    public function rules()
    {
        return [
            'date'          => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'distance_type' => [
                'required',
            ],
            'weight_type'   => [
                'required',
            ],
            'fakturs.*'     => [
                'integer',
            ],
            'fakturs'       => [
                'required',
                'array',
            ],
        ];
    }
}
