<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DailyAttendanceTemplate;
use App\Exports\DailyWeldReportTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportAttendanceRequest;
use App\Http\Requests\ImportAttendanceTemplateRequest;
use App\Http\Requests\ImportWeldingRequest;
use App\Http\Requests\ImportWeldingTemplateRequest;
use App\Http\Requests\MassDestroyAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Imports\DailyAttendance;
use App\Models\Attendance;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendances = Attendance::with(['user'])->get();

        $users = User::get();

        return view('admin.attendances.index', compact('attendances', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.attendances.create', compact('users'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::create($request->all());

        return redirect()->route('admin.attendances.index');
    }

    public function edit(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendance->load('user');

        return view('admin.attendances.edit', compact('users', 'attendance'));
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return redirect()->route('admin.attendances.index');
    }

    public function show(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->load('user');

        return view('admin.attendances.show', compact('attendance'));
    }

    public function destroy(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendanceRequest $request)
    {
        Attendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function importTemplate(ImportAttendanceTemplateRequest $request) {
        setlocale(LC_TIME, 'id');
        $dateString = $request->get('date');
        return (new DailyAttendanceTemplate(sprintf('Laporan Absen %s', Carbon::createFromFormat('d/m/Y', $dateString)->formatLocalized("%A %d/%m/%Y"))))
            ->download(
                sprintf('Laporan Absen %s.xlsx', Carbon::createFromFormat('d/m/Y', $dateString)->formatLocalized("%A %d-%m-%Y"))
                , null, ['Access-Control-Allow-Origin' => '*', 'Access-Control-Allow-Methods' => 'GET']
            );
    }

    public function import(ImportAttendanceRequest $request) {
        rename($request->file('file')->getPathname(), $request->file('file')->getPathname().'.'.$request->file('file')->getClientOriginalExtension());
        (new DailyAttendance)->import($request->file('file')->getPathname().'.'.$request->file('file')->getClientOriginalExtension());

        return redirect('/admin');
    }
}
