<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalaryConstantRequest;
use App\Http\Requests\StoreSalaryConstantRequest;
use App\Http\Requests\UpdateSalaryConstantRequest;
use App\Models\Role;
use App\Models\SalaryConstant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalaryConstantController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('salary_constant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryConstants = SalaryConstant::with(['role'])->get();

        return view('admin.salaryConstants.index', compact('salaryConstants'));
    }

    public function create()
    {
        abort_if(Gate::denies('salary_constant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.salaryConstants.create', compact('roles'));
    }

    public function store(StoreSalaryConstantRequest $request)
    {
        $salaryConstant = SalaryConstant::create($request->all());

        return redirect()->route('admin.salary-constants.index');
    }

    public function edit(SalaryConstant $salaryConstant)
    {
        abort_if(Gate::denies('salary_constant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salaryConstant->load('role');

        return view('admin.salaryConstants.edit', compact('roles', 'salaryConstant'));
    }

    public function update(UpdateSalaryConstantRequest $request, SalaryConstant $salaryConstant)
    {
        $salaryConstant->update($request->all());

        return redirect()->route('admin.salary-constants.index');
    }

    public function show(SalaryConstant $salaryConstant)
    {
        abort_if(Gate::denies('salary_constant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryConstant->load('role');

        return view('admin.salaryConstants.show', compact('salaryConstant'));
    }

    public function destroy(SalaryConstant $salaryConstant)
    {
        abort_if(Gate::denies('salary_constant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryConstant->delete();

        return back();
    }

    public function massDestroy(MassDestroySalaryConstantRequest $request)
    {
        SalaryConstant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
