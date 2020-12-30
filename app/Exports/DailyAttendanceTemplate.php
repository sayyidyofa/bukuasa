<?php


namespace App\Exports;


use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyAttendanceTemplate implements FromCollection
{
    use Exportable;

    /**
     * @var string
     */
    private string $dateString;

    public function __construct(string $dateString)
    {
        $this->dateString = $dateString;
    }

    public function collection()
    {
        $exportCollection = collect([]);

        // Tanggal
        $exportCollection->push(collect([$this->dateString]));

        // Header
        $exportCollection->push(collect(['Karyawan', 'Status', 'Keterangan']));

        // Nama
        User::whereHas('roles', fn($q) => $q->whereIn('title', ['Welder', 'Driver', 'Assembler', 'Foreman']))->get()->pluck('name')->each(fn($uglyphp) => $exportCollection->push(collect([$uglyphp])));

        return $exportCollection;
    }
}