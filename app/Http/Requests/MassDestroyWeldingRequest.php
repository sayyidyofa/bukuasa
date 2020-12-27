<?php

namespace App\Http\Requests;

use App\Models\Welding;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWeldingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('welding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:weldings,id',
        ];
    }
}
