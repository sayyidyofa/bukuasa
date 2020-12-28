<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPembayaranRequest;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Faktur;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PembayaranController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pembayaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pembayarans = Pembayaran::with(['faktur', 'customer', 'media'])->get();

        $fakturs = Faktur::get();

        $pelanggans = Pelanggan::get();

        return view('admin.pembayarans.index', compact('pembayarans', 'fakturs', 'pelanggans'));
    }

    public function create()
    {
        abort_if(Gate::denies('pembayaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakturs = Faktur::all()->pluck('no_faktur', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = Pelanggan::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pembayarans.create', compact('fakturs', 'customers'));
    }

    public function store(StorePembayaranRequest $request)
    {
        $pembayaran = Pembayaran::create($request->all());

        if ($request->input('payment_proof', false)) {
            $pembayaran->addMedia(storage_path('tmp/uploads/' . $request->input('payment_proof')))->toMediaCollection('payment_proof');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pembayaran->id]);
        }

        return redirect()->route('admin.pembayarans.index');
    }

    public function edit(Pembayaran $pembayaran)
    {
        abort_if(Gate::denies('pembayaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakturs = Faktur::all()->pluck('no_faktur', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = Pelanggan::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pembayaran->load('faktur', 'customer');

        return view('admin.pembayarans.edit', compact('fakturs', 'customers', 'pembayaran'));
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

        return redirect()->route('admin.pembayarans.index');
    }

    public function show(Pembayaran $pembayaran)
    {
        abort_if(Gate::denies('pembayaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pembayaran->load('faktur', 'customer');

        return view('admin.pembayarans.show', compact('pembayaran'));
    }

    public function destroy(Pembayaran $pembayaran)
    {
        abort_if(Gate::denies('pembayaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pembayaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyPembayaranRequest $request)
    {
        Pembayaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pembayaran_create') && Gate::denies('pembayaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pembayaran();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
