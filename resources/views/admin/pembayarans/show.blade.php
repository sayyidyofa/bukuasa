@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pembayaran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pembayarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.id') }}
                        </th>
                        <td>
                            {{ $pembayaran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.faktur') }}
                        </th>
                        <td>
                            {{ $pembayaran->faktur->no_faktur ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.customer') }}
                        </th>
                        <td>
                            {{ $pembayaran->customer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Pembayaran::TYPE_RADIO[$pembayaran->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.holder') }}
                        </th>
                        <td>
                            {{ App\Models\Pembayaran::HOLDER_RADIO[$pembayaran->holder] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.nth_payment') }}
                        </th>
                        <td>
                            {{ $pembayaran->nth_payment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.nominal') }}
                        </th>
                        <td>
                            {{ $pembayaran->nominal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.payment_date') }}
                        </th>
                        <td>
                            {{ $pembayaran->payment_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $pembayaran->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pembayaran.fields.payment_proof') }}
                        </th>
                        <td>
                            @if($pembayaran->payment_proof)
                                <a href="{{ $pembayaran->payment_proof->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $pembayaran->payment_proof->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pembayarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection