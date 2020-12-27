@can('crew_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.crews.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.crew.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.crew.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-deliveryCrews">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.crew.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.crew.fields.delivery') }}
                        </th>
                        <th>
                            {{ trans('cruds.crew.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.crew.fields.role') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($crews as $key => $crew)
                        <tr data-entry-id="{{ $crew->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $crew->id ?? '' }}
                            </td>
                            <td>
                                {{ $crew->delivery->date ?? '' }}
                            </td>
                            <td>
                                {{ $crew->user->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Crew::ROLE_RADIO[$crew->role] ?? '' }}
                            </td>
                            <td>
                                @can('crew_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.crews.show', $crew->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('crew_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.crews.edit', $crew->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('crew_delete')
                                    <form action="{{ route('admin.crews.destroy', $crew->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('crew_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crews.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-deliveryCrews:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection