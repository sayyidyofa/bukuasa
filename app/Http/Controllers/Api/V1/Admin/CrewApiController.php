<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrewRequest;
use App\Http\Requests\UpdateCrewRequest;
use App\Http\Resources\Admin\CrewResource;
use App\Models\Crew;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CrewApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('crew_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrewResource(Crew::with(['delivery', 'user'])->get());
    }

    public function store(StoreCrewRequest $request)
    {
        $crew = Crew::create($request->all());

        return (new CrewResource($crew))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Crew $crew)
    {
        abort_if(Gate::denies('crew_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrewResource($crew->load(['delivery', 'user']));
    }

    public function update(UpdateCrewRequest $request, Crew $crew)
    {
        $crew->update($request->all());

        return (new CrewResource($crew))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Crew $crew)
    {
        abort_if(Gate::denies('crew_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crew->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
