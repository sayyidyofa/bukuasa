@extends('layouts.admin')
@section('content')
@can('kasbon_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kasbons.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kasbon.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kasbon.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Kasbon">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kasbon.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.kasbon.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.kasbon.fields.nominal') }}
                        </th>
                        <th>
                            {{ trans('cruds.kasbon.fields.cut_start') }}
                        </th>
                        <th>
                            {{ trans('cruds.kasbon.fields.cut_end') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kasbons as $key => $kasbon)
                        <tr data-entry-id="{{ $kasbon->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $kasbon->id ?? '' }}
                            </td>
                            <td>
                                {{ $kasbon->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $kasbon->nominal ?? '' }}
                            </td>
                            <td>
                                {{ $kasbon->cut_start ?? '' }}
                            </td>
                            <td>
                                {{ $kasbon->cut_end ?? '' }}
                            </td>
                            <td>
                                @can('kasbon_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kasbons.show', $kasbon->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('kasbon_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kasbons.edit', $kasbon->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('kasbon_delete')
                                    <form action="{{ route('admin.kasbons.destroy', $kasbon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('kasbon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kasbons.massDestroy') }}",
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
  let table = $('.datatable-Kasbon:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection