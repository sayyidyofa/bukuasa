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

class CrewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('crew_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crews = Crew::with(['delivery', 'user'])->get();

        return view('admin.crews.index', compact('crews'));
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
