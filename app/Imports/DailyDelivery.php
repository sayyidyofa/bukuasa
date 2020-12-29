<?php


namespace App\Imports;


use App\Models\Delivery;
use App\Models\Crew;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DailyDelivery implements ToCollection, WithHeadingRow
{
    use Importable;

    private array $currentMergedValue;
    private string $tglPengiriman;

    /**
     * @return string
     */
    public function getTglPengiriman(): string
    {
        return $this->tglPengiriman;
    }

    /**
     * @param string $tglPengiriman
     */
    public function setTglPengiriman(string $tglPengiriman): void
    {
        $this->tglPengiriman = $tglPengiriman;
    }

    /**
     * @return array
     */
    public function getCurrentMergedValue(): array
    {
        return $this->currentMergedValue;
    }

    /**
     * @param array $currentMergedValue
     */
    public function setCurrentMergedValue(array $currentMergedValue): void
    {
        $this->currentMergedValue = $currentMergedValue;
    }

    /**
     * @inheritDoc
     */
    public function collection(Collection $collection) {
        $normalCollection = collect();
        $this->setTglPengiriman($collection->first()['tanggal']);
        //dd(Carbon::createFromFormat('d m Y', $this->getTglPengiriman()));
        $collection->each(function ($item) use ($normalCollection) {

            if ([$item['no'], $item['kategori_jarak'], $item['kategori_berat'], $item['no_faktur']] !== [null, null, null, null]) {
                $this->setCurrentMergedValue([
                    'no' => $item['no'],
                    'kategori_jarak' => $item['kategori_jarak'],
                    'kategori_berat' => $item['kategori_berat'],
                    'no_faktur' => $item['no_faktur']]);
            }
            $normalCollection->push(collect([
                'no' => $this->getCurrentMergedValue()['no'],
                'kategori_jarak' => $this->getCurrentMergedValue()['kategori_jarak'],
                'kategori_berat' => $this->getCurrentMergedValue()['kategori_berat'],
                'no_faktur' => $this->getCurrentMergedValue()['no_faktur'],
                'karyawan' => $item['karyawan'],
                'peran' => $item['peran']]));
        });

        $groupedByNo = $normalCollection->groupBy('no');

        $groupedByNo->each(function (Collection $collection) {
            $pengiriman = new Delivery([
                'date' => Carbon::createFromFormat('d m Y', $this->getTglPengiriman())->format('d/m/Y'),
                'distance_type' => $collection->first()['kategori_jarak'] < 2 ? 'near': 'far',
                'weight_type' => $collection->first()['kategori_berat'] < 2 ? 'ordinary' : 'heavy'
            ]);
            $pengiriman->save();
            $pengiriman->fakturs()->sync(strpos($collection->first()['no_faktur'], ', ') !== false ? explode(', ', $collection->first()['no_faktur']) : [$collection->first()['no_faktur']]);

            $collection->each(function (Collection $subCol) use ($pengiriman) {
                (new Crew([
                    'user_id' => User::where('name', 'like', '%'.$subCol['karyawan'].'%')->get()->first()->id,
                    'role' => $subCol['peran']
                ]))->delivery()->associate($pengiriman)->save();
            });
        });
    }

    public function headingRow(): int {
        return 2;
    }
}