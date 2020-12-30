<?php


namespace App\Imports;


use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Welding;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\Regex\Regex;

class DailyWeldReport implements ToCollection
{
    use Importable;

    private int $productId;
    private int $keping;
    private float $weight;
    private string $dateString;
    private int $welderId;

    /**
     * @return int
     */
    public function getWelderId(): int
    {
        return $this->welderId;
    }

    /**
     * @param int $welderId
     */
    public function setWelderId(int $welderId): void
    {
        $this->welderId = $welderId;
    }

    /**
     * @return int
     */
    public function getKeping(): int
    {
        return $this->keping;
    }

    /**
     * @param int $keping
     */
    public function setKeping(int $keping): void
    {
        $this->keping = $keping;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getDateString(): string
    {
        return $this->dateString;
    }

    /**
     * @param string $dateString
     */
    public function setDateString(string $dateString): void
    {
        $this->dateString = $dateString;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function collection(Collection $collection)
    {
        $allRows = $collection;
        $this->setDateString(Regex::match('/[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/', $allRows->first()->first())->result());

        $allRows->each(function (Collection $row, int $index) use ($allRows) {
            $productsCount = Product::count();
            $batas = $productsCount + 3;
            if ($index >= 3 && $index < $batas) {
                $row->each(function ($value, int $subIdx) use ($allRows) {
                    if ($subIdx === 1) {
                        //dd(Regex::match('/(?<=\[).+?(?=\])/', $value)->result());
                        $this->setProductId(Regex::match('/(?<=\[).+?(?=\])/', $value)->result()); // https://stackoverflow.com/a/27225148/8885105
                    }
                    elseif ($subIdx >= 2) {
                        if ($subIdx % 2 == 0) {
                            $this->setKeping($value);
                            $this->setWelderId(User::where('name', '=', $allRows[1][$subIdx])->get()->first()->id);
                        } else {
                            $this->setWeight($value);
                            (new Welding([
                                'date' => $this->getDateString(),
                                'user_id' => $this->getWelderId(),
                                'product_id' => $this->getProductId(),
                                'weight_kg' => $this->getWeight(),
                                'amount_unit' => $this->getKeping()
                            ]))->save();
                        }
                    }
                });
            }
        });
    }
}