@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cart.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.id') }}
                        </th>
                        <td>
                            {{ $cart->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.faktur') }}
                        </th>
                        <td>
                            {{ $cart->faktur->no_faktur ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.product') }}
                        </th>
                        <td>
                            {{ $cart->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.weight_kg') }}
                        </th>
                        <td>
                            {{ $cart->weight_kg }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.amount_unit') }}
                        </th>
                        <td>
                            {{ $cart->amount_unit }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection