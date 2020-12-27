<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDeliveryRequest;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Models\Delivery;
use App\Models\Faktur;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('delivery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Delivery::with(['fakturs'])->select(sprintf('%s.*', (new Delivery)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'delivery_show';
                $editGate      = 'delivery_edit';
                $deleteGate    = 'delivery_delete';
                $crudRoutePart = 'deliveries';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });

            $table->editColumn('distance_type', function ($row) {
                return $row->distance_type ? Delivery::DISTANCE_TYPE_RADIO[$row->distance_type] : '';
            });
            $table->editColumn('weight_type', function ($row) {
                return $row->weight_type ? Delivery::WEIGHT_TYPE_RADIO[$row->weight_type] : '';
            });
            $table->editColumn('faktur', function ($row) {
                $labels = [];

                foreach ($row->fakturs as $faktur) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $faktur->no_faktur);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'faktur']);

            return $table->make(true);
        }

        return view('admin.deliveries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('delivery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakturs = Faktur::all()->pluck('no_faktur', 'id');

        return view('admin.deliveries.create', compact('fakturs'));
    }

    public function store(StoreDeliveryRequest $request)
    {
        $delivery = Delivery::create($request->all());
        $delivery->fakturs()->sync($request->input('fakturs', []));

        return redirect()->route('admin.deliveries.index');
    }

    public function edit(Delivery $delivery)
    {
        abort_if(Gate::denies('delivery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakturs = Faktur::all()->pluck('no_faktur', 'id');

        $delivery->load('fakturs');

        return view('admin.deliveries.edit', compact('fakturs', 'delivery'));
    }

    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->all());
        $delivery->fakturs()->sync($request->input('fakturs', []));

        return redirect()->route('admin.deliveries.index');
    }

    public function show(Delivery $delivery)
    {
        abort_if(Gate::denies('delivery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delivery->load('fakturs', 'deliveryCrews');

        return view('admin.deliveries.show', compact('delivery'));
    }

    public function destroy(Delivery $delivery)
    {
        abort_if(Gate::denies('delivery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delivery->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeliveryRequest $request)
    {
        Delivery::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
