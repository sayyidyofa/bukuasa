@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Input Gaji Mingguan Tanggal {{ \Carbon\Carbon::parse($startDate)->format('d m Y') }} s.d {{ \Carbon\Carbon::parse($endDate)->format('d m Y') }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.weeklySalaryProcess') }}" method="post">
                @csrf
                <input type="hidden" name="from" value="{{ $startDate }}">
                <input type="hidden" name="to" value="{{ $endDate }}">
                @foreach($viewData as $roleName => $salariesByRole)
                    @if($roleName === '')
                    @else
                        <div class="card">
                            <div class="card-header">
                                {{ $roleName }}
                            </div>
                            <div class="card-body">
                                @foreach($salariesByRole as $userId => $salaryByUser)
                                    <input type="hidden" name="{{'id-'.$userId}}" value="{{ $userId }}">
                                    <input class="form-control" type="hidden" name="{{'nominal-'.$userId}}" id="{{'nominal-'.$userId}}" value="{{ $salaryByUser }}" readonly>
                                    <div class="card">
                                        <div class="card-header">
                                            {{ \App\Models\User::whereId($userId)->first()->name }}
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="required" for="{{'placeholder-nominal-'.$userId}}">{{ trans('cruds.salary.fields.nominal') }}</label>
                                                <input class="form-control" type="text" name="{{'placeholder-nominal-'.$userId}}" id="{{'placeholder-nominal-'.$userId}}" value="{{ rupiah($salaryByUser) }}" disabled>
                                                <span class="help-block">Nilai Gaji telah dikalkulasikan</span>
                                            </div>
                                            <div class="form-group">
                                                <label class="required" for="{{'markup-'.$userId}}">Dibulatkan menjadi</label>
                                                <input type="text" class="form-control {{ $errors->has('markup-'.$userId) ? 'is-invalid' : '' }}" name="{{'markup-'.$userId}}" id="{{'markup-'.$userId}}" value="{{ old('markup', '') }}" required>
                                                @if($errors->has('markup-'.$userId))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('markup-'.$userId) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="{{'keterangan-'.$userId}}">{{ trans('cruds.salary.fields.keterangan') }}</label>
                                                <input class="form-control {{ $errors->has('keterangan-'.$userId) ? 'is-invalid' : '' }}" type="text" name="{{'keterangan-'.$userId}}" id="{{'keterangan-'.$userId}}" value="{{ old('keterangan', '') }}">
                                                @if($errors->has('keterangan-'.$userId))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('keterangan-'.$userId) }}
                                                    </div>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.salary.fields.keterangan_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection