<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DailyWeldReportTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportWeldingRequest;
use App\Http\Requests\ImportWeldingTemplateRequest;
use App\Http\Requests\MassDestroyWeldingRequest;
use App\Http\Requests\StoreWeldingRequest;
use App\Http\Requests\UpdateWeldingRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\Welding;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class WeldingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('welding_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weldings = Welding::with(['user', 'product'])->get();

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

    public function importTemplate(ImportWeldingTemplateRequest $request) {
        setlocale(LC_TIME, 'id');
        $dateString = $request->get('date');
        return (new DailyWeldReportTemplate(sprintf('Laporan Hasil Las %s', Carbon::createFromFormat('d/m/Y', $dateString)->formatLocalized("%A %d/%m/%Y"))))
            ->download(
                sprintf('Laporan Hasil Las %s.xlsx', Carbon::createFromFormat('d/m/Y', $dateString)->formatLocalized("%A %d-%m-%Y"))
                , null, ['Access-Control-Allow-Origin' => '*', 'Access-Control-Allow-Methods' => 'GET']
            );
    }

    public function import(ImportWeldingRequest $request) {
        rename($request->file('file')->getPathname(), $request->file('file')->getPathname().'.'.$request->file('file')->getClientOriginalExtension());
        (new \App\Imports\DailyWeldReport)->import($request->file('file')->getPathname().'.'.$request->file('file')->getClientOriginalExtension());

        return view('home');
    }
}
