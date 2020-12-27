<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKasbonRequest;
use App\Http\Requests\UpdateKasbonRequest;
use App\Http\Resources\Admin\KasbonResource;
use App\Models\Kasbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KasbonApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kasbon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KasbonResource(Kasbon::with(['user'])->get());
    }

    public function store(StoreKasbonRequest $request)
    {
        $kasbon = Kasbon::create($request->all());

        return (new KasbonResource($kasbon))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Kasbon $kasbon)
    {
        abort_if(Gate::denies('kasbon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KasbonResource($kasbon->load(['user']));
    }

    public function update(UpdateKasbonRequest $request, Kasbon $kasbon)
    {
        $kasbon->update($request->all());

        return (new KasbonResource($kasbon))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Kasbon $kasbon)
    {
        abort_if(Gate::denies('kasbon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kasbon->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
