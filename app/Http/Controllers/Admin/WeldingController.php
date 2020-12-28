<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWeldingRequest;
use App\Http\Requests\StoreWeldingRequest;
use App\Http\Requests\UpdateWeldingRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\Welding;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WeldingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('welding_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weldings = Welding::with(['user', 'product', 'media'])->get();

        $users = User::get();

        $products = Product::get();

        return view('admin.weldings.index', compact('weldings', 'users', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('welding_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.weldings.create', compact('users', 'products'));
    }

    public function store(StoreWeldingRequest $request)
    {
        $welding = Welding::create($request->all());

        if ($request->input('photo', false)) {
            $welding->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $welding->id]);
        }

        return redirect()->route('admin.weldings.index');
    }

    public function edit(Welding $welding)
    {
        abort_if(Gate::denies('welding_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $welding->load('user', 'product');

        return view('admin.weldings.edit', compact('users', 'products', 'welding'));
    }

    public function update(UpdateWeldingRequest $request, Welding $welding)
    {
        $welding->update($request->all());

        if ($request->input('photo', false)) {
            if (!$welding->photo || $request->input('photo') !== $welding->photo->file_name) {
                if ($welding->photo) {
                    $welding->photo->delete();
                }

                $welding->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($welding->photo) {
            $welding->photo->delete();
        }

        return redirect()->route('admin.weldings.index');
    }

    public function show(Welding $welding)
    {
        abort_if(Gate::denies('welding_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $welding->load('user', 'product');

        return view('admin.weldings.show', compact('welding'));
    }

    public function destroy(Welding $welding)
    {
        abort_if(Gate::denies('welding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $welding->delete();

        return back();
    }

    public function massDestroy(MassDestroyWeldingRequest $request)
    {
        Welding::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('welding_create') && Gate::denies('welding_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Welding();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
