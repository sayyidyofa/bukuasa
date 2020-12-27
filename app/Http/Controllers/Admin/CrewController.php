<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCrewRequest;
use App\Http\Requests\StoreCrewRequest;
use App\Http\Requests\UpdateCrewRequest;
use App\Models\Crew;
use App\Models\Delivery;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CrewController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('crew_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Crew::with(['delivery', 'user'])->select(sprintf('%s.*', (new Crew)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'crew_show';
                $editGate      = 'crew_edit';
                $deleteGate    = 'crew_delete';
                $crudRoutePart = 'crews';

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
            $table->addColumn('delivery_date', function ($row) {
                return $row->delivery ? $row->delivery->date : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('role', function ($row) {
                return $row->role ? Crew::ROLE_RADIO[$row->role] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'delivery', 'user']);

            return $table->make(true);
        }

        return view('admin.crews.index');
    }

    public function create()
    {
        abort_if(Gate::denies('crew_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveries = Delivery::all()->pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.crews.create', compact('deliveries', 'users'));
    }

    public function store(StoreCrewRequest $request)
    {
        $crew = Crew::create($request->all());

        return redirect()->route('admin.crews.index');
    }

    public function edit(Crew $crew)
    {
        abort_if(Gate::denies('crew_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveries = Delivery::all()->pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $crew->load('delivery', 'user');

        return view('admin.crews.edit', compact('deliveries', 'users', 'crew'));
    }

    public function update(UpdateCrewRequest $request, Crew $crew)
    {
        $crew->update($request->all());

        return redirect()->route('admin.crews.index');
    }

    public function show(Crew $crew)
    {
        abort_if(Gate::denies('crew_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crew->load('delivery', 'user');

        return view('admin.crews.show', compact('crew'));
    }

    public function destroy(Crew $crew)
    {
        abort_if(Gate::denies('crew_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crew->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrewRequest $request)
    {
        Crew::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
