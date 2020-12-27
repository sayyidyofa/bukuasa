@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.kasbon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kasbons.update", [$kasbon->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.kasbon.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $kasbon->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kasbon.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nominal">{{ trans('cruds.kasbon.fields.nominal') }}</label>
                <input class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}" type="number" name="nominal" id="nominal" value="{{ old('nominal', $kasbon->nominal) }}" step="0.01" required>
                @if($errors->has('nominal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nominal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kasbon.fields.nominal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cut_start">{{ trans('cruds.kasbon.fields.cut_start') }}</label>
                <input class="form-control date {{ $errors->has('cut_start') ? 'is-invalid' : '' }}" type="text" name="cut_start" id="cut_start" value="{{ old('cut_start', $kasbon->cut_start) }}" required>
                @if($errors->has('cut_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cut_start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kasbon.fields.cut_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cut_end">{{ trans('cruds.kasbon.fields.cut_end') }}</label>
                <input class="form-control date {{ $errors->has('cut_end') ? 'is-invalid' : '' }}" type="text" name="cut_end" id="cut_end" value="{{ old('cut_end', $kasbon->cut_end) }}" required>
                @if($errors->has('cut_end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cut_end') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kasbon.fields.cut_end_helper') }}</span>
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