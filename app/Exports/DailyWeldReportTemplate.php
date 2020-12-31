<?php


namespace App\Exports;


use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyWeldReportTemplate implements FromCollection
{
    use Exportable;

    /**
     * @var string
     */
    private $dateString;

    public function __construct(string $dateString)
    {
        $this->dateString = $dateString;
    }

    public function collection()
    {
        $base = collect([]);
        // Tanggal
        $base->push(collect([$this->dateString]));

        // Header
        $headerAtas = collect(['Kategori', 'Barang']);
        $headerBawah = collect([null, null]);
        User::whereHas('roles', function ($q) {
            return $q->where('title', config('roles.welder'));
        })->get(['name'])->pluck('name')->each(function ($elem) use ($headerBawah, $headerAtas) {
            $headerAtas->push($elem);
            $headerAtas->push(null);

            $headerBawah->push('Keping');
            $headerBawah->push('Kilo');
        });
        $base->push($headerAtas);
        $base->push($headerBawah);

        // Kategori dan Barang
        $katbarangs = collect([]);
        $categorizedProducts = ProductCategory::with('productCategoryProducts')
            ->get()
            ->transform(fn(ProductCategory $category) => collect($category->only(['name', 'productCategoryProducts'])))
            ->each(fn(Collection $category) => $category->get('productCategoryProducts')
                ->transform(fn(Product $product) => ['name' => sprintf('[%d] %s', $product->id, $product->name)]))
            ->transform(fn($coll) => $coll->flatten())
            ->toArray();
        foreach ($categorizedProducts as $mergedArray) {
            $katbarangs->push(collect([$mergedArray[0], $mergedArray[1]]));
            for ($idx = 2; $idx < count($mergedArray); $idx++) {
                $katbarangs->push(collect([null, $mergedArray[$idx]]));
            }
        }
        $base->push($katbarangs);
        return $base;
    }
}
