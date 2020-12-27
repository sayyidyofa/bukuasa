<?php

namespace App\Http\Requests;

use App\Models\Faktur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFakturRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('faktur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fakturs,id',
        ];
    }
}
