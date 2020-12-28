@extends('layouts.admin')
@section('content')
@can('overtime_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.overtimes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.overtime.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.overtime.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Overtime">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.overtime.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.overtime.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.overtime.fields.dept') }}
                        </th>
                        <th>
                            {{ trans('cruds.overtime.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.overtime.fields.start_hour') }}
                        </th>
                        <th>
                            {{ trans('cruds.overtime.fields.end_hour') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overtimes as $key => $overtime)
                        <tr data-entry-id="{{ $overtime->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $overtime->id ?? '' }}
                            </td>
                            <td>
                                {{ $overtime->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $overtime->dept ?? '' }}
                            </td>
                            <td>
                                {{ $overtime->date ?? '' }}
                            </td>
                            <td>
                                {{ $overtime->start_hour ?? '' }}
                            </td>
                            <td>
                                {{ $overtime->end_hour ?? '' }}
                            </td>
                            <td>
                                @can('overtime_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.overtimes.show', $overtime->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('overtime_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.overtimes.edit', $overtime->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('overtime_delete')
                                    <form action="{{ route('admin.overtimes.destroy', $overtime->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('overtime_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.overtimes.massDestroy') }}",
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
    order: [[ 4, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Overtime:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection