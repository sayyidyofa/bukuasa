@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.overtime.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.overtimes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.overtime.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.overtime.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dept">{{ trans('cruds.overtime.fields.dept') }}</label>
                <input class="form-control {{ $errors->has('dept') ? 'is-invalid' : '' }}" type="text" name="dept" id="dept" value="{{ old('dept', '') }}" required>
                @if($errors->has('dept'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dept') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.overtime.fields.dept_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.overtime.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.overtime.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_hour">{{ trans('cruds.overtime.fields.start_hour') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_hour') ? 'is-invalid' : '' }}" type="text" name="start_hour" id="start_hour" value="{{ old('start_hour') }}" required>
                @if($errors->has('start_hour'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_hour') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.overtime.fields.start_hour_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_hour">{{ trans('cruds.overtime.fields.end_hour') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_hour') ? 'is-invalid' : '' }}" type="text" name="end_hour" id="end_hour" value="{{ old('end_hour') }}" required>
                @if($errors->has('end_hour'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_hour') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.overtime.fields.end_hour_helper') }}</span>
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