<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFakturRequest;
use App\Http\Requests\StoreFakturRequest;
use App\Http\Requests\UpdateFakturRequest;
use App\Models\Faktur;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FakturController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('faktur_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakturs = Faktur::with(['media'])->get();

        return view('admin.fakturs.index', compact('fakturs'));
    }

    public function create()
    {
        abort_if(Gate::denies('faktur_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakturs.create');
    }

    public function store(StoreFakturRequest $request)
    {
        $faktur = Faktur::create($request->all());

        if ($request->input('photo', false)) {
            $faktur->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $faktur->id]);
        }

        return redirect()->route('admin.fakturs.index');
    }

    public function edit(Faktur $faktur)
    {
        abort_if(Gate::denies('faktur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakturs.edit', compact('faktur'));
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

        return redirect()->route('admin.fakturs.index');
    }

    public function show(Faktur $faktur)
    {
        abort_if(Gate::denies('faktur_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faktur->load('fakturCarts', 'fakturPembayarans', 'fakturDeliveries');

        return view('admin.fakturs.show', compact('faktur'));
    }

    public function destroy(Faktur $faktur)
    {
        abort_if(Gate::denies('faktur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faktur->delete();

        return back();
    }

    public function massDestroy(MassDestroyFakturRequest $request)
    {
        Faktur::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('faktur_create') && Gate::denies('faktur_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Faktur();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
