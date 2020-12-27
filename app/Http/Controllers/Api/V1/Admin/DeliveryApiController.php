<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Http\Resources\Admin\DeliveryResource;
use App\Models\Delivery;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('delivery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryResource(Delivery::with(['fakturs'])->get());
    }

    public function store(StoreDeliveryRequest $request)
    {
        $delivery = Delivery::create($request->all());
        $delivery->fakturs()->sync($request->input('fakturs', []));

        return (new DeliveryResource($delivery))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Delivery $delivery)
    {
        abort_if(Gate::denies('delivery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryResource($delivery->load(['fakturs']));
    }

    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->all());
        $delivery->fakturs()->sync($request->input('fakturs', []));

        return (new DeliveryResource($delivery))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Delivery $delivery)
    {
        abort_if(Gate::denies('delivery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delivery->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
