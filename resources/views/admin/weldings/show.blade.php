@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.welding.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.weldings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.id') }}
                        </th>
                        <td>
                            {{ $welding->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.date') }}
                        </th>
                        <td>
                            {{ $welding->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.user') }}
                        </th>
                        <td>
                            {{ $welding->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.product') }}
                        </th>
                        <td>
                            {{ $welding->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.weight_kg') }}
                        </th>
                        <td>
                            {{ $welding->weight_kg }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.amount_unit') }}
                        </th>
                        <td>
                            {{ $welding->amount_unit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.welding.fields.photo') }}
                        </th>
                        <td>
                            @if($welding->photo)
                                <a href="{{ $welding->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $welding->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.weldings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection