@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cart.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="faktur_id">{{ trans('cruds.cart.fields.faktur') }}</label>
                <select class="form-control select2 {{ $errors->has('faktur') ? 'is-invalid' : '' }}" name="faktur_id" id="faktur_id" required>
                    @foreach($fakturs as $id => $faktur)
                        <option value="{{ $id }}" {{ old('faktur_id') == $id ? 'selected' : '' }}>{{ $faktur }}</option>
                    @endforeach
                </select>
                @if($errors->has('faktur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('faktur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.faktur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.cart.fields.product') }}</label>
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
                <span class="help-block">{{ trans('cruds.cart.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weight_kg">{{ trans('cruds.cart.fields.weight_kg') }}</label>
                <input class="form-control {{ $errors->has('weight_kg') ? 'is-invalid' : '' }}" type="number" name="weight_kg" id="weight_kg" value="{{ old('weight_kg', '') }}" step="0.01" required>
                @if($errors->has('weight_kg'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight_kg') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.weight_kg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_unit">{{ trans('cruds.cart.fields.amount_unit') }}</label>
                <input class="form-control {{ $errors->has('amount_unit') ? 'is-invalid' : '' }}" type="number" name="amount_unit" id="amount_unit" value="{{ old('amount_unit', '') }}" step="1">
                @if($errors->has('amount_unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.amount_unit_helper') }}</span>
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