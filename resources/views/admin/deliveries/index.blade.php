@extends('layouts.admin')
@section('content')
@can('delivery_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.deliveries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.delivery.title_singular') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.deliveryImport') }}" enctype="multipart/form-data" method="post">
                @csrf
                <label for="file">Upload File laporan</label>
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-dark">Upload</button>
            </form>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.delivery.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Delivery">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.delivery.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.delivery.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.delivery.fields.distance_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.delivery.fields.weight_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.delivery.fields.faktur') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deliveries as $key => $delivery)
                        <tr data-entry-id="{{ $delivery->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $delivery->id ?? '' }}
                            </td>
                            <td>
                                {{ $delivery->date ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Delivery::DISTANCE_TYPE_RADIO[$delivery->distance_type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Delivery::WEIGHT_TYPE_RADIO[$delivery->weight_type] ?? '' }}
                            </td>
                            <td>
                                @foreach($delivery->fakturs as $key => $item)
                                    <span class="badge badge-info">{{ $item->no_faktur }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('delivery_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.deliveries.show', $delivery->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('delivery_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.deliveries.edit', $delivery->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('delivery_delete')
                                    <form action="{{ route('admin.deliveries.destroy', $delivery->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('delivery_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.deliveries.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Delivery:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection