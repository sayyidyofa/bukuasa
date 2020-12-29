@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pembayaran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pembayarans.update", [$pembayaran->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="faktur_id">{{ trans('cruds.pembayaran.fields.faktur') }}</label>
                <select class="form-control select2 {{ $errors->has('faktur') ? 'is-invalid' : '' }}" name="faktur_id" id="faktur_id" required>
                    @foreach($fakturs as $id => $faktur)
                        <option value="{{ $id }}" {{ (old('faktur_id') ? old('faktur_id') : $pembayaran->faktur->id ?? '') == $id ? 'selected' : '' }}>{{ $faktur }}</option>
                    @endforeach
                </select>
                @if($errors->has('faktur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('faktur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.faktur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pembayaran.fields.type') }}</label>
                @foreach(App\Models\Pembayaran::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', $pembayaran->type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pembayaran.fields.holder') }}</label>
                @foreach(App\Models\Pembayaran::HOLDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('holder') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="holder_{{ $key }}" name="holder" value="{{ $key }}" {{ old('holder', $pembayaran->holder) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="holder_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('holder'))
                    <div class="invalid-feedback">
                        {{ $errors->first('holder') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.holder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nth_payment">{{ trans('cruds.pembayaran.fields.nth_payment') }}</label>
                <input class="form-control {{ $errors->has('nth_payment') ? 'is-invalid' : '' }}" type="number" name="nth_payment" id="nth_payment" value="{{ old('nth_payment', $pembayaran->nth_payment) }}" step="1">
                @if($errors->has('nth_payment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nth_payment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.nth_payment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nominal">{{ trans('cruds.pembayaran.fields.nominal') }}</label>
                <input class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}" type="number" name="nominal" id="nominal" value="{{ old('nominal', $pembayaran->nominal) }}" step="0.01" required>
                @if($errors->has('nominal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nominal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.nominal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_date">{{ trans('cruds.pembayaran.fields.payment_date') }}</label>
                <input class="form-control date {{ $errors->has('payment_date') ? 'is-invalid' : '' }}" type="text" name="payment_date" id="payment_date" value="{{ old('payment_date', $pembayaran->payment_date) }}" required>
                @if($errors->has('payment_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.payment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.pembayaran.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', $pembayaran->keterangan) }}">
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_proof">{{ trans('cruds.pembayaran.fields.payment_proof') }}</label>
                <div class="needsclick dropzone {{ $errors->has('payment_proof') ? 'is-invalid' : '' }}" id="payment_proof-dropzone">
                </div>
                @if($errors->has('payment_proof'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_proof') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pembayaran.fields.payment_proof_helper') }}</span>
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
    Dropzone.options.paymentProofDropzone = {
    url: '{{ route('admin.pembayarans.storeMedia') }}',
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
      $('form').find('input[name="payment_proof"]').remove()
      $('form').append('<input type="hidden" name="payment_proof" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="payment_proof"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pembayaran) && $pembayaran->payment_proof)
      var file = {!! json_encode($pembayaran->payment_proof) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="payment_proof" value="' + file.file_name + '">')
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