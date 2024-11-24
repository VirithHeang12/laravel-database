<?php

namespace App\Exports;

use App\Models\Car;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ProductsExport implements FromView, WithCustomStartCell
{
    // /**
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function query(): \Illuminate\Database\Eloquent\Builder
    // {
    //     return Product::query();
    // }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('products.export', [
            'products' => Product::all()
        ]);
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'B2';
    }

}
