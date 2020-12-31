@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.salaryConstant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salary-constants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryConstant.fields.id') }}
                        </th>
                        <td>
                            {{ $salaryConstant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryConstant.fields.name') }}
                        </th>
                        <td>
                            {{ $salaryConstant->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryConstant.fields.nominal') }}
                        </th>
                        <td>
                            {{ $salaryConstant->nominal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salaryConstant.fields.role') }}
                        </th>
                        <td>
                            {{ $salaryConstant->role->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.salary-constants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection