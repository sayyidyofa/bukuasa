<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKasbonRequest;
use App\Http\Requests\StoreKasbonRequest;
use App\Http\Requests\UpdateKasbonRequest;
use App\Models\Kasbon;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KasbonController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('kasbon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kasbon::with(['user'])->select(sprintf('%s.*', (new Kasbon)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'kasbon_show';
                $editGate      = 'kasbon_edit';
                $deleteGate    = 'kasbon_delete';
                $crudRoutePart = 'kasbons';

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

            $table->editColumn('nominal', function ($row) {
                return $row->nominal ? $row->nominal : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.kasbons.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kasbon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kasbons.create', compact('users'));
    }

    public function store(StoreKasbonRequest $request)
    {
        $kasbon = Kasbon::create($request->all());

        return redirect()->route('admin.kasbons.index');
    }

    public function edit(Kasbon $kasbon)
    {
        abort_if(Gate::denies('kasbon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kasbon->load('user');

        return view('admin.kasbons.edit', compact('users', 'kasbon'));
    }

    public function update(UpdateKasbonRequest $request, Kasbon $kasbon)
    {
        $kasbon->update($request->all());

        return redirect()->route('admin.kasbons.index');
    }

    public function show(Kasbon $kasbon)
    {
        abort_if(Gate::denies('kasbon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kasbon->load('user');

        return view('admin.kasbons.show', compact('kasbon'));
    }

    public function destroy(Kasbon $kasbon)
    {
        abort_if(Gate::denies('kasbon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kasbon->delete();

        return back();
    }

    public function massDestroy(MassDestroyKasbonRequest $request)
    {
        Kasbon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
