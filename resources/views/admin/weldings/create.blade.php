@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.welding.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.weldings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.welding.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.welding.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.welding.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.welding.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.welding.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.welding.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weight_kg">{{ trans('cruds.welding.fields.weight_kg') }}</label>
                <input class="form-control {{ $errors->has('weight_kg') ? 'is-invalid' : '' }}" type="number" name="weight_kg" id="weight_kg" value="{{ old('weight_kg', '') }}" step="0.01" required>
                @if($errors->has('weight_kg'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight_kg') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.welding.fields.weight_kg_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount_unit">{{ trans('cruds.welding.fields.amount_unit') }}</label>
                <input class="form-control {{ $errors->has('amount_unit') ? 'is-invalid' : '' }}" type="number" name="amount_unit" id="amount_unit" value="{{ old('amount_unit', '') }}" step="1" required>
                @if($errors->has('amount_unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.welding.fields.amount_unit_helper') }}</span>
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