<?php


namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ImportAttendanceTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_access');
    }

    public function rules()
    {
        return [
            'date' => 'required'
        ];
    }
}