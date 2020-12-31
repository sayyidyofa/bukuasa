<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaryConstantRequest;
use App\Http\Requests\UpdateSalaryConstantRequest;
use App\Http\Resources\Admin\SalaryConstantResource;
use App\Models\SalaryConstant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalaryConstantApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('salary_constant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalaryConstantResource(SalaryConstant::with(['role'])->get());
    }

    public function store(StoreSalaryConstantRequest $request)
    {
        $salaryConstant = SalaryConstant::create($request->all());

        return (new SalaryConstantResource($salaryConstant))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SalaryConstant $salaryConstant)
    {
        abort_if(Gate::denies('salary_constant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SalaryConstantResource($salaryConstant->load(['role']));
    }

    public function update(UpdateSalaryConstantRequest $request, SalaryConstant $salaryConstant)
    {
        $salaryConstant->update($request->all());

        return (new SalaryConstantResource($salaryConstant))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SalaryConstant $salaryConstant)
    {
        abort_if(Gate::denies('salary_constant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaryConstant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
