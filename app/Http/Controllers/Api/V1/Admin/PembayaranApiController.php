<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Http\Resources\Admin\PembayaranResource;
use App\Models\Pembayaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PembayaranApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pembayaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PembayaranResource(Pembayaran::with(['faktur'])->get());
    }

    public function store(StorePembayaranRequest $request)
    {
        $pembayaran = Pembayaran::create($request->all());

        if ($request->input('payment_proof', false)) {
            $pembayaran->addMedia(storage_path('tmp/uploads/' . $request->input('payment_proof')))->toMediaCollection('payment_proof');
        }

        return (new PembayaranResource($pembayaran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pembayaran $pembayaran)
    {
        abort_if(Gate::denies('pembayaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PembayaranResource($pembayaran->load(['faktur']));
    }

    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        $pembayaran->update($request->all());

        if ($request->input('payment_proof', false)) {
            if (!$pembayaran->payment_proof || $request->input('payment_proof') !== $pembayaran->payment_proof->file_name) {
                if ($pembayaran->payment_proof) {
                    $pembayaran->payment_proof->delete();
                }

                $pembayaran->addMedia(storage_path('tmp/uploads/' . $request->input('payment_proof')))->toMediaCollection('payment_proof');
            }
        } elseif ($pembayaran->payment_proof) {
            $pembayaran->payment_proof->delete();
        }

        return (new PembayaranResource($pembayaran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        abort_if(Gate::denies('pembayaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pembayaran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
