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

class KasbonController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kasbon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kasbons = Kasbon::with(['user'])->get();

        return view('admin.kasbons.index', compact('kasbons'));
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
