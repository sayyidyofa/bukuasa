<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalaryRequest;
use App\Http\Requests\MonthlySalaryFormRequest;
use App\Http\Requests\MonthlySalaryProcessRequest;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Http\Requests\WeeklySalaryFormRequest;
use App\Http\Requests\WeeklySalaryProcessRequest;
use App\Models\Attendance;
use App\Models\Product;
use App\Models\Salary;
use App\Models\SalaryConstant;
use App\Models\User;
use App\Models\Welding;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class SalaryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salaries = Salary::with(['user'])->get();

        return view('admin.salaries.index', compact('salaries'));
    }

    public function create()
    {
        abort_if(Gate::denies('salary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.salaries.create', compact('users'));
    }

    public function store(StoreSalaryRequest $request)
    {
        $salary = Salary::create($request->all());

        return redirect()->route('admin.salaries.index');
    }

    public function edit(Salary $salary)
    {
        abort_if(Gate::denies('salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $salary->load('user');

        return view('admin.salaries.edit', compact('users', 'salary'));
    }

    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $salary->update($request->all());

        return redirect()->route('admin.salaries.index');
    }

    public function show(Salary $salary)
    {
        abort_if(Gate::denies('salary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->load('user');

        return view('admin.salaries.show', compact('salary'));
    }

    public function destroy(Salary $salary)
    {
        abort_if(Gate::denies('salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary->delete();

        return back();
    }

    public function massDestroy(MassDestroySalaryRequest $request)
    {
        Salary::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function weeklySalaryForm(WeeklySalaryFormRequest $request) {

        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $weldings = Welding::whereBetween('date', [$startDate, $endDate])
            ->get(['user_id', 'amount_unit', 'weight_kg', 'product_id'])
            ->groupBy('user_id')->transform(fn($perUserId) => $perUserId->groupBy('product_id'))
            ->each(fn($perUserAgain) => $perUserAgain
                ->transform(fn(Collection $perProductId, int $index) => $perProductId->sum->amount_unit*Product::whereId($index)->first()->rate_keping))
            ->transform(fn(Collection $perUserYetAgain, int $index) => $perUserYetAgain->sum()
            );

        $otherWeekly = Attendance::whereStatus('hadir')
            ->select(['id', 'user_id'])
            ->with(['user' => fn($query) => $query->select('id'), 'user.roles' => fn($query) => $query->select(['id', 'title'])])
            ->whereBetween('date', [$startDate, $endDate])
            ->get()
            ->groupBy(fn($item) => $item->user->roles->first()->title)
            ->forget(config('roles.welder'))
            ->transform(fn($cole) => $cole->groupBy('user_id'))
            ->each(fn ($colee) => $colee
                ->transform(fn ($coleee) =>
                    $coleee->count() * $colee->first()->first()->user->salaryConstant()
                    + ($coleee->count() === 6 && $colee->first()->first()->user->salaryConstant() <= SalaryConstant::where('name', '=', 'Bare Minimum Bonus Kehadiran')->get()->first()->nominal
                        ? SalaryConstant::where('name', '=', 'Bonus Kehadiran')->get()->first()->nominal
                        : 0
                    )
                )
            );

        $otherWeekly->put('Operator Las', $weldings);

        $viewData = $otherWeekly;

        return view('admin.salaries.form.weekly', compact(
            'viewData', 'startDate', 'endDate'
        ));
    }

    public function monthlySalaryForm(MonthlySalaryFormRequest $request) {
        $year = $request->get('year');
        $month = $request->get('month');

        $employees = User::whereHas('roles', fn($q) => $q->whereIn('title', config('roles.monthly')))->get();
        $oldData = Salary::with('user', fn($q) => $q->whereIn('id', $employees->pluck('id')))->whereMonth('from', '=', $month)->whereMonth('to', '=', $month)->get();

        return view('admin.salaries.form.monthly', compact(
            'year', 'month', 'employees', 'oldData'
        ));

    }

    public function weeklySalaryProcess(WeeklySalaryProcessRequest $request) {
        dd($request->all());
    }

    public function monthlySalaryProcess(MonthlySalaryProcessRequest $request) {

    }
}
