@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kasbon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kasbons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kasbon.fields.id') }}
                        </th>
                        <td>
                            {{ $kasbon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kasbon.fields.user') }}
                        </th>
                        <td>
                            {{ $kasbon->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kasbon.fields.nominal') }}
                        </th>
                        <td>
                            {{ $kasbon->nominal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kasbon.fields.cut_start') }}
                        </th>
                        <td>
                            {{ $kasbon->cut_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kasbon.fields.cut_end') }}
                        </th>
                        <td>
                            {{ $kasbon->cut_end }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kasbons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection