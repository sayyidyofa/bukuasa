@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.faktur.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fakturs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="pelanggan_id">{{ trans('cruds.faktur.fields.pelanggan') }}</label>
                <select class="form-control select2 {{ $errors->has('pelanggan') ? 'is-invalid' : '' }}" name="pelanggan_id" id="pelanggan_id" required>
                    @foreach($pelanggans as $id => $pelanggan)
                        <option value="{{ $id }}" {{ old('pelanggan_id') == $id ? 'selected' : '' }}>{{ $pelanggan }}</option>
                    @endforeach
                </select>
                @if($errors->has('pelanggan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pelanggan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faktur.fields.pelanggan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_faktur">{{ trans('cruds.faktur.fields.no_faktur') }}</label>
                <input class="form-control {{ $errors->has('no_faktur') ? 'is-invalid' : '' }}" type="number" name="no_faktur" id="no_faktur" value="{{ old('no_faktur', '') }}" step="1" required>
                @if($errors->has('no_faktur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_faktur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faktur.fields.no_faktur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_faktur">{{ trans('cruds.faktur.fields.tgl_faktur') }}</label>
                <input class="form-control date {{ $errors->has('tgl_faktur') ? 'is-invalid' : '' }}" type="text" name="tgl_faktur" id="tgl_faktur" value="{{ old('tgl_faktur') }}" required>
                @if($errors->has('tgl_faktur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_faktur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faktur.fields.tgl_faktur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tagihan">{{ trans('cruds.faktur.fields.tagihan') }}</label>
                <input class="form-control {{ $errors->has('tagihan') ? 'is-invalid' : '' }}" type="number" name="tagihan" id="tagihan" value="{{ old('tagihan', '') }}" step="0.01" required>
                @if($errors->has('tagihan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tagihan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faktur.fields.tagihan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="diskon_markup">{{ trans('cruds.faktur.fields.diskon_markup') }}</label>
                <input class="form-control {{ $errors->has('diskon_markup') ? 'is-invalid' : '' }}" type="number" name="diskon_markup" id="diskon_markup" value="{{ old('diskon_markup', '') }}" step="0.01">
                @if($errors->has('diskon_markup'))
                    <div class="invalid-feedback">
                        {{ $errors->first('diskon_markup') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faktur.fields.diskon_markup_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.faktur.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faktur.fields.photo_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.fakturs.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($faktur) && $faktur->photo)
      var file = {!! json_encode($faktur->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection