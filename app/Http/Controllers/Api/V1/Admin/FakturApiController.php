<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFakturRequest;
use App\Http\Requests\UpdateFakturRequest;
use App\Http\Resources\Admin\FakturResource;
use App\Models\Faktur;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FakturApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('faktur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FakturResource(Faktur::all());
    }

    public function store(StoreFakturRequest $request)
    {
        $faktur = Faktur::create($request->all());

        if ($request->input('photo', false)) {
            $faktur->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new FakturResource($faktur))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Faktur $faktur)
    {
        abort_if(Gate::denies('faktur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FakturResource($faktur);
    }

    public function update(UpdateFakturRequest $request, Faktur $faktur)
    {
        $faktur->update($request->all());

        if ($request->input('photo', false)) {
            if (!$faktur->photo || $request->input('photo') !== $faktur->photo->file_name) {
                if ($faktur->photo) {
                    $faktur->photo->delete();
                }

                $faktur->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($faktur->photo) {
            $faktur->photo->delete();
        }

        return (new FakturResource($faktur))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Faktur $faktur)
    {
        abort_if(Gate::denies('faktur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faktur->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
