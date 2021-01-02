@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Input Gaji Bulan {{ $month }}&nbsp;{{ $year }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.monthlySalaryProcess') }}">
                @csrf

            </form>
        </div>
    </div>
@endsection