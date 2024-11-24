<?php

namespace App\Exports;

use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuppliersExport implements FromView, WithCustomStartCell
{
    private Collection $fails;
    private int $successesCount = 0;
    private int $failsCount = 0;

    /**
     * Set the successes count
     *
     * @param int $successesCount
     *
     * @return void
     */
    public function setSuccessesCount(int $successesCount): void
    {
        $this->successesCount = $successesCount;
    }

    /**
     * Set the fails count
     *
     * @param int $failsCount
     *
     * @return void
     */
    public function setFailsCount(int $failsCount): void
    {
        $this->failsCount = $failsCount;
    }

    /**
     * Set the fails
     *
     * @param Collection $fails
     *
     * @return void
     */

    public function setFails(Collection $fails): void
    {
        $this->fails = $fails;
    }

    // /**
    //  * WithHeadings
    //  *
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function headings(): array
    // {
    //     return [
    //         '#',
    //         'Successes',
    //         "$this->successesCount",
    //         'Fails',
    //         "$this->failsCount",
    //     ];
    // }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     // return $this->fails;
    //     return Supplier::all();
    // }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $suppliers = Supplier::all();

        $emailCategories = $suppliers->groupBy(function ($supplier) {
            $domain = substr(strrchr($supplier->email, "@"), 1);
            return explode('.', $domain)[1] ?? 'unknown';
        })->map(function ($group) {
            return $group->count(); // Count suppliers in each group
        });

        return view('suppliers.export', [
            'suppliers' => $suppliers,
            'emailCategories' => $emailCategories
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
