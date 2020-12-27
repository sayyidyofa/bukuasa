<?php

namespace App\Http\Requests;

use App\Models\Overtime;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOvertimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('overtime_create');
    }

    public function rules()
    {
        return [
            'user_id'    => [
                'required',
                'integer',
            ],
            'dept'       => [
                'string',
                'required',
            ],
            'date'       => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start_hour' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_hour'   => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
