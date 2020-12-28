@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.salary.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.id') }}
                        </th>
                        <td>
                            {{ $salary->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.user') }}
                        </th>
                        <td>
                            {{ $salary->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.nominal') }}
                        </th>
                        <td>
                            {{ $salary->nominal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.markup') }}
                        </th>
                        <td>
                            {{ $salary->markup }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $salary->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.from') }}
                        </th>
                        <td>
                            {{ $salary->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salary.fields.to') }}
                        </th>
                        <td>
                            {{ $salary->to }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection