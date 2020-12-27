<?php

namespace App\Http\Requests;

use App\Models\Kasbon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKasbonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kasbon_create');
    }

    public function rules()
    {
        return [
            'user_id'   => [
                'required',
                'integer',
            ],
            'nominal'   => [
                'required',
            ],
            'cut_start' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'cut_end'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
