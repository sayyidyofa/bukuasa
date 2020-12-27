@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.crew.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crews.update", [$crew->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="delivery_id">{{ trans('cruds.crew.fields.delivery') }}</label>
                <select class="form-control select2 {{ $errors->has('delivery') ? 'is-invalid' : '' }}" name="delivery_id" id="delivery_id" required>
                    @foreach($deliveries as $id => $delivery)
                        <option value="{{ $id }}" {{ (old('delivery_id') ? old('delivery_id') : $crew->delivery->id ?? '') == $id ? 'selected' : '' }}>{{ $delivery }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crew.fields.delivery_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.crew.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $crew->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crew.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.crew.fields.role') }}</label>
                @foreach(App\Models\Crew::ROLE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('role') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="role_{{ $key }}" name="role" value="{{ $key }}" {{ old('role', $crew->role) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crew.fields.role_helper') }}</span>
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