@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.delivery.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.deliveries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.delivery.fields.id') }}
                        </th>
                        <td>
                            {{ $delivery->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delivery.fields.date') }}
                        </th>
                        <td>
                            {{ $delivery->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delivery.fields.distance_type') }}
                        </th>
                        <td>
                            {{ App\Models\Delivery::DISTANCE_TYPE_RADIO[$delivery->distance_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delivery.fields.weight_type') }}
                        </th>
                        <td>
                            {{ App\Models\Delivery::WEIGHT_TYPE_RADIO[$delivery->weight_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.delivery.fields.faktur') }}
                        </th>
                        <td>
                            @foreach($delivery->fakturs as $key => $faktur)
                                <span class="label label-info">{{ $faktur->no_faktur }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.deliveries.index') }}">
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
            <a class="nav-link" href="#delivery_crews" role="tab" data-toggle="tab">
                {{ trans('cruds.crew.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="delivery_crews">
            @includeIf('admin.deliveries.relationships.deliveryCrews', ['crews' => $delivery->deliveryCrews])
        </div>
    </div>
</div>

@endsection