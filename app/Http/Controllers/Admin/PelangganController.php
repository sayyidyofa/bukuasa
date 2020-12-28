<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPelangganRequest;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\Pelanggan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelangganController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pelanggan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelanggans = Pelanggan::all();

        return view('admin.pelanggans.index', compact('pelanggans'));
    }

    public function create()
    {
        abort_if(Gate::denies('pelanggan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pelanggans.create');
    }

    public function store(StorePelangganRequest $request)
    {
        $pelanggan = Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggans.index');
    }

    public function edit(Pelanggan $pelanggan)
    {
        abort_if(Gate::denies('pelanggan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pelanggans.edit', compact('pelanggan'));
    }

    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggans.index');
    }

    public function show(Pelanggan $pelanggan)
    {
        abort_if(Gate::denies('pelanggan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelanggan->load('customerPembayarans');

        return view('admin.pelanggans.show', compact('pelanggan'));
    }

    public function destroy(Pelanggan $pelanggan)
    {
        abort_if(Gate::denies('pelanggan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelanggan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPelangganRequest $request)
    {
        Pelanggan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
