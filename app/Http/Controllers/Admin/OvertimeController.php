<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOvertimeRequest;
use App\Http\Requests\StoreOvertimeRequest;
use App\Http\Requests\UpdateOvertimeRequest;
use App\Models\Overtime;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OvertimeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('overtime_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $overtimes = Overtime::with(['user'])->get();

        return view('admin.overtimes.index', compact('overtimes'));
    }

    public function create()
    {
        abort_if(Gate::denies('overtime_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.overtimes.create', compact('users'));
    }

    public function store(StoreOvertimeRequest $request)
    {
        $overtime = Overtime::create($request->all());

        return redirect()->route('admin.overtimes.index');
    }

    public function edit(Overtime $overtime)
    {
        abort_if(Gate::denies('overtime_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $overtime->load('user');

        return view('admin.overtimes.edit', compact('users', 'overtime'));
    }

    public function update(UpdateOvertimeRequest $request, Overtime $overtime)
    {
        $overtime->update($request->all());

        return redirect()->route('admin.overtimes.index');
    }

    public function show(Overtime $overtime)
    {
        abort_if(Gate::denies('overtime_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $overtime->load('user');

        return view('admin.overtimes.show', compact('overtime'));
    }

    public function destroy(Overtime $overtime)
    {
        abort_if(Gate::denies('overtime_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $overtime->delete();

        return back();
    }

    public function massDestroy(MassDestroyOvertimeRequest $request)
    {
        Overtime::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
