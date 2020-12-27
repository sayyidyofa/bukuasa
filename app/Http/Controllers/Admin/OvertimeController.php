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
use Yajra\DataTables\Facades\DataTables;

class OvertimeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('overtime_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Overtime::with(['user'])->select(sprintf('%s.*', (new Overtime)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'overtime_show';
                $editGate      = 'overtime_edit';
                $deleteGate    = 'overtime_delete';
                $crudRoutePart = 'overtimes';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('dept', function ($row) {
                return $row->dept ? $row->dept : "";
            });

            $table->editColumn('start_hour', function ($row) {
                return $row->start_hour ? $row->start_hour : "";
            });
            $table->editColumn('end_hour', function ($row) {
                return $row->end_hour ? $row->end_hour : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.overtimes.index');
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
