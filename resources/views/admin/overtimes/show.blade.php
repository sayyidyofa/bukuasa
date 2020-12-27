@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.overtime.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.overtimes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.overtime.fields.id') }}
                        </th>
                        <td>
                            {{ $overtime->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.overtime.fields.user') }}
                        </th>
                        <td>
                            {{ $overtime->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.overtime.fields.dept') }}
                        </th>
                        <td>
                            {{ $overtime->dept }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.overtime.fields.date') }}
                        </th>
                        <td>
                            {{ $overtime->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.overtime.fields.start_hour') }}
                        </th>
                        <td>
                            {{ $overtime->start_hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.overtime.fields.end_hour') }}
                        </th>
                        <td>
                            {{ $overtime->end_hour }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.overtimes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection