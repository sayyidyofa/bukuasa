<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeldingRequest;
use App\Http\Requests\UpdateWeldingRequest;
use App\Http\Resources\Admin\WeldingResource;
use App\Models\Welding;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeldingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('welding_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WeldingResource(Welding::with(['user', 'product'])->get());
    }

    public function store(StoreWeldingRequest $request)
    {
        $welding = Welding::create($request->all());

        return (new WeldingResource($welding))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Welding $welding)
    {
        abort_if(Gate::denies('welding_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WeldingResource($welding->load(['user', 'product']));
    }

    public function update(UpdateWeldingRequest $request, Welding $welding)
    {
        $welding->update($request->all());

        return (new WeldingResource($welding))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Welding $welding)
    {
        abort_if(Gate::denies('welding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $welding->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
