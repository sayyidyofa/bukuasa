@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rate_keping">{{ trans('cruds.product.fields.rate_keping') }}</label>
                <input class="form-control {{ $errors->has('rate_keping') ? 'is-invalid' : '' }}" type="number" name="rate_keping" id="rate_keping" value="{{ old('rate_keping', $product->rate_keping) }}" step="0.01" required>
                @if($errors->has('rate_keping'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rate_keping') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.rate_keping_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_category_id">{{ trans('cruds.product.fields.product_category') }}</label>
                <select class="form-control select2 {{ $errors->has('product_category') ? 'is-invalid' : '' }}" name="product_category_id" id="product_category_id" required>
                    @foreach($product_categories as $id => $product_category)
                        <option value="{{ $id }}" {{ (old('product_category_id') ? old('product_category_id') : $product->product_category->id ?? '') == $id ? 'selected' : '' }}>{{ $product_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_category_helper') }}</span>
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