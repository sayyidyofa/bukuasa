@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.attendance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.id') }}
                        </th>
                        <td>
                            {{ $attendance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.date') }}
                        </th>
                        <td>
                            {{ $attendance->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.user') }}
                        </th>
                        <td>
                            {{ $attendance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Attendance::STATUS_RADIO[$attendance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendance.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $attendance->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection