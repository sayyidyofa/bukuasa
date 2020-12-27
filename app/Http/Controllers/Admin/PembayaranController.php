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
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pembayaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pembayaran::with(['faktur', 'customer'])->select(sprintf('%s.*', (new Pembayaran)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'pembayaran_show';
                $editGate      = 'pembayaran_edit';
                $deleteGate    = 'pembayaran_delete';
                $crudRoutePart = 'pembayarans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('faktur_no_faktur', function ($row) {
                return $row->faktur ? $row->faktur->no_faktur : '';
            });

            $table->addColumn('customer_name', function ($row) {
                return $row->customer ? $row->customer->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Pembayaran::TYPE_RADIO[$row->type] : '';
            });
            $table->editColumn('holder', function ($row) {
                return $row->holder ? Pembayaran::HOLDER_RADIO[$row->holder] : '';
            });
            $table->editColumn('nth_payment', function ($row) {
                return $row->nth_payment ? $row->nth_payment : "";
            });
            $table->editColumn('nominal', function ($row) {
                return $row->nominal ? $row->nominal : "";
            });

            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'faktur', 'customer']);

            return $table->make(true);
        }

        $fakturs    = Faktur::get();
        $pelanggans = Pelanggan::get();

        return view('admin.pembayarans.index', compact('fakturs', 'pelanggans'));
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
