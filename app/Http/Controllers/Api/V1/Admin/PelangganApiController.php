<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Http\Resources\Admin\PelangganResource;
use App\Models\Pelanggan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelangganApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pelanggan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PelangganResource(Pelanggan::all());
    }

    public function store(StorePelangganRequest $request)
    {
        $pelanggan = Pelanggan::create($request->all());

        return (new PelangganResource($pelanggan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pelanggan $pelanggan)
    {
        abort_if(Gate::denies('pelanggan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PelangganResource($pelanggan);
    }

    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());

        return (new PelangganResource($pelanggan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pelanggan $pelanggan)
    {
        abort_if(Gate::denies('pelanggan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelanggan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
