@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.faktur.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fakturs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.faktur.fields.id') }}
                        </th>
                        <td>
                            {{ $faktur->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faktur.fields.no_faktur') }}
                        </th>
                        <td>
                            {{ $faktur->no_faktur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faktur.fields.tgl_faktur') }}
                        </th>
                        <td>
                            {{ $faktur->tgl_faktur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faktur.fields.tagihan') }}
                        </th>
                        <td>
                            {{ $faktur->tagihan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faktur.fields.diskon_markup') }}
                        </th>
                        <td>
                            {{ $faktur->diskon_markup }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faktur.fields.photo') }}
                        </th>
                        <td>
                            @if($faktur->photo)
                                <a href="{{ $faktur->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $faktur->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fakturs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#faktur_carts" role="tab" data-toggle="tab">
                {{ trans('cruds.cart.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#faktur_pembayarans" role="tab" data-toggle="tab">
                {{ trans('cruds.pembayaran.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#faktur_deliveries" role="tab" data-toggle="tab">
                {{ trans('cruds.delivery.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="faktur_carts">
            @includeIf('admin.fakturs.relationships.fakturCarts', ['carts' => $faktur->fakturCarts])
        </div>
        <div class="tab-pane" role="tabpanel" id="faktur_pembayarans">
            @includeIf('admin.fakturs.relationships.fakturPembayarans', ['pembayarans' => $faktur->fakturPembayarans])
        </div>
        <div class="tab-pane" role="tabpanel" id="faktur_deliveries">
            @includeIf('admin.fakturs.relationships.fakturDeliveries', ['deliveries' => $faktur->fakturDeliveries])
        </div>
    </div>
</div>

@endsection