@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pelanggan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pelanggans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pelanggan.fields.id') }}
                        </th>
                        <td>
                            {{ $pelanggan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pelanggan.fields.name') }}
                        </th>
                        <td>
                            {{ $pelanggan->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pelanggan.fields.address') }}
                        </th>
                        <td>
                            {{ $pelanggan->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pelanggan.fields.contact') }}
                        </th>
                        <td>
                            {{ $pelanggan->contact }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pelanggans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#pelanggan_fakturs" role="tab" data-toggle="tab">
                {{ trans('cruds.faktur.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="pelanggan_fakturs">
            @includeIf('admin.pelanggans.relationships.pelangganFakturs', ['fakturs' => $pelanggan->pelangganFakturs])
        </div>
    </div>
</div>

@endsection