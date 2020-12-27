@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.delivery.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.deliveries.update", [$delivery->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.delivery.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $delivery->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delivery.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.delivery.fields.distance_type') }}</label>
                @foreach(App\Models\Delivery::DISTANCE_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('distance_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="distance_type_{{ $key }}" name="distance_type" value="{{ $key }}" {{ old('distance_type', $delivery->distance_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="distance_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('distance_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('distance_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delivery.fields.distance_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.delivery.fields.weight_type') }}</label>
                @foreach(App\Models\Delivery::WEIGHT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('weight_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="weight_type_{{ $key }}" name="weight_type" value="{{ $key }}" {{ old('weight_type', $delivery->weight_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="weight_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('weight_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delivery.fields.weight_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fakturs">{{ trans('cruds.delivery.fields.faktur') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('fakturs') ? 'is-invalid' : '' }}" name="fakturs[]" id="fakturs" multiple required>
                    @foreach($fakturs as $id => $faktur)
                        <option value="{{ $id }}" {{ (in_array($id, old('fakturs', [])) || $delivery->fakturs->contains($id)) ? 'selected' : '' }}>{{ $faktur }}</option>
                    @endforeach
                </select>
                @if($errors->has('fakturs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fakturs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.delivery.fields.faktur_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection