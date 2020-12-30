<?php


namespace App\Imports;


use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\Regex\Regex;

class DailyAttendance implements ToCollection
{
    use Importable;

    private string $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function collection(Collection $collection)
    {
        $rows = $collection;
        $date = Regex::match('/[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/', $rows->first()->first())->result();
        $rows->each(function (Collection $row, int $index) use ($date) {
            if ($index >= 2) {
                switch($row[1]) {
                    case '1':
                        $this->setStatus('hadir');
                        break;
                    case '2':
                        $this->setStatus('izin');
                        break;
                    case '3':
                        $this->setStatus('alfa');
                        break;
                }
                (new Attendance([
                    'user_id' => User::where('name', 'like', '%'.$row[0].'%')->get()->first()->id,
                    'status' => $this->getStatus(),
                    'date' => $date,
                    'keterangan' => $row[2]
                ]))->save();
            }
        });
    }

}